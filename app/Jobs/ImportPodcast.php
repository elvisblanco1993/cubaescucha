<?php

namespace App\Jobs;

use Exception;
use Carbon\Carbon;
use App\Models\Episode;
use App\Models\Podcast;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use App\Mail\NotifyPodcastImported;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use App\Mail\NotifyFailedPodcastImport;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Notifications\NotifyAdminAboutPodcastImport;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use App\Notifications\SystemMessagesNotification;

class ImportPodcast implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable;

    public $feed;
    public $podcast_url;
    public $team_id;
    public $user_email;

    public $timeout = 3600;
    public $uniqueFor = 3600;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($rss_url, $podcast_url, $team_id, $user_email)
    {
        $this->feed = $rss_url;
        $this->podcast_url = $podcast_url;
        $this->team_id = $team_id;
        $this->user_email = $user_email;
    }

    /**
     * Get the cache driver for the unique job lock.
     *
     * @return \Illuminate\Contracts\Cache\Repository
     */
    public function uniqueVia()
    {
        return Cache::driver('redis');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $admin = \App\Models\User::where('email', 'eblanco@voicebits.co');

        Log::notice("/--------------------------------------------------------");
        Log::notice("/ NEW JOB: IMPORT PODCAST [" . $this->feed . "]");
        Log::notice("/--------------------------------------------------------");


        try {
            $feed = simplexml_load_file($this->feed);
        } catch (\Throwable $e) {
            Log::error("Failed to load remote feed: " . $e->getMessage());
            $admin->notify(new NotifyAdminAboutPodcastImport( "Failed to load remote feed: " . $e->getMessage() . ". " . $this->feed ));
            Mail::to($this->user_email)->send(new NotifyFailedPodcastImport());
        }

        if (!empty($feed)) {

            // Gets the metadata from the RSS URL
            $podcast_name = $feed->channel->title;
            $podcast_description = strip_tags($feed->channel->description);
            $podcast_lang = $feed->channel->language;
            $podcast_tags = $feed->xpath("//itunes:category")[0]['text'];
            $podcast_type = $feed->xpath("//itunes:type")[0];
            $podcast_explicit = ($feed->xpath("//itunes:explicit")[0] == 'yes' || $feed->xpath("//itunes:explicit")[0] == TRUE) ? 1 : 0;
            $podcast_thumbnail = ( !empty($feed->channel->image->url) ) ? $feed->channel->image->url : $feed->xpath("//itunes:image")[0]['href']->__toString();

            // Store thumbnail on s3
            $thumbnail_contents = file_get_contents($podcast_thumbnail);
            $thumbnail_name = substr(substr($podcast_thumbnail, strrpos($podcast_thumbnail, '/') + 1), 0, strpos(substr($podcast_thumbnail, strrpos($podcast_thumbnail, '/') + 1), '?'));

            try {
                Storage::disk('local')->put('podcasts/covers/'.$thumbnail_name, $thumbnail_contents, 'public');
            } catch (Exception $e) {
                Log::error("Error importing podcast cover image: " . $e->getMessage());
                $admin->notify(new NotifyAdminAboutPodcastImport( "Error importing podcast cover image: " . $e->getMessage() . ". " . $this->feed ));
                \App\Models\User::findOrFail(1)->notify(new SystemMessagesNotification("Error importing podcast cover image: " . $e->getMessage()));
            }

            // Create Podcast
            $podcast = Podcast::create([
                'team_id' => $this->team_id,
                'name' => $podcast_name,
                'slug' => Str::slug($podcast_name),
                'url' => $this->podcast_url,
                'description' => $podcast_description,
                'tags' => $podcast_tags,
                'lang' => $podcast_lang,
                'style' => $podcast_type,
                'explicit' => $podcast_explicit,
                'thumbnail' => 'podcasts/covers/'.$thumbnail_name,
                'website_style' => 'modern',
            ]);


            // Import episodes
            if ($podcast && $feed->channel->item->count() > 0) {

                Log::notice("Got episodes. Lets check if they are enumerated.");

                // Order episodes with older first, newer last
                if (empty($feed->channel->item->xpath("//itunes:episode")) == TRUE) {
                    Log::notice("Episodes not enumerated. The episodes will be created without a number and will be sorted by publishing date.");
                }

                Log::notice("Done checking if episodes are enumerated. Start creating episodes.");

                // Get metadata information from each episode
                foreach ($feed->channel->item as $episode) {

                    $episode_title = $episode->title;

                    $episode_description = $episode->xpath("./itunes:summary")[0];

                    $episode_pubDate = Carbon::createFromTimestamp(strtotime($episode->pubDate))->toDateTimeString();

                    $episode_type = $episode->episodeType;

                    $episode_number = ( !empty($feed->channel->item->xpath("//itunes:episode")) && !empty( $episode->xpath("./itunes:episode")[0] ) ) ? $episode->xpath("./itunes:episode")[0] : null;

                    $episode_duration = ( !empty($feed->channel->item->xpath("//itunes:duration")) && !empty( $episode->xpath("./itunes:duration")[0] ) ) ? $episode->xpath("./itunes:duration")[0] : 0;

                    $episode_url = $episode->enclosure['url'];

                    $episode_explicit = ( !empty($feed->channel->item->xpath("//itunes:explicit")) && !empty( $episode->xpath("./itunes:explicit")[0] ) ) ? $episode->xpath("./itunes:explicit")[0] : 0;

                    Log::notice("Episode metadata collected.");

                    // Import the episode media file to s3
                    $file_contents = file_get_contents($episode_url);
                    $file_name = 'podcasts/episodes/'. uniqid() . '.' . substr(pathinfo($episode_url, PATHINFO_EXTENSION), 0, strpos(pathinfo($episode_url, PATHINFO_EXTENSION), "?"));

                    try {

                        Storage::disk('episodes')->put($file_name, $file_contents);

                        Log::notice("Saved " . $file_name . " to drive");
                    } catch (\Throwable $e) {
                        Log::error("Failed to save " . $file_name . " to drive: " . $e);
                        $admin->notify(new NotifyAdminAboutPodcastImport( "Failed to save " . $file_name . " to drive: " . $e . ". " . $this->feed ));
                        report($e);
                        \App\Models\User::findOrFail(1)->notify(new SystemMessagesNotification("Failed to save " . $file_name . ": " . $e->getMessage()));
                    }

                    // Create episode
                    $new_episode = new Episode([
                        'uuid' => strtotime(Carbon::now()),
                        'podcast_id' => $podcast->id,
                        'title' => $episode_title,
                        'show_notes' => $episode_description,
                        'type' => $episode_type,
                        'downloadable' => true,
                        'file_name' => $file_name,
                        'audio_duration' => $episode_duration,
                        'explicit' => ($episode_explicit == 'yes') ? TRUE : FALSE,
                        'season' => ($podcast->style == 'episode with season') ? $this->season : null,
                        'episode_no' => $episode_number,
                        'created_at' => $episode_pubDate,
                        'published_at' => $episode_pubDate,
                    ]);

                    $new_episode->save();
                }

                Log::notice("Podcast " . $podcast_name . " was successfully imported.");
                Log::notice("Closing job...");
                // Send success email notification to user
                Log::notice("Sending success email to podcast owner");

                $admin->notify(new NotifyAdminAboutPodcastImport( "Podcast " . $podcast_name . " was successfully imported. " . $this->feed ));

                Mail::to($this->user_email)->send(new NotifyPodcastImported());
                Log::notice("Email sent...");

            } else {
                $podcast->delete();
                Log::error("Either the podcast was not created or the podcast does not have any episodes");
                Log::notice("Sending failure email to owner and support");

                $admin->notify(new NotifyAdminAboutPodcastImport( "Either the podcast was not created or the podcast does not have any episodes: " . $this->feed ));

                Mail::to($this->user_email)->send(new NotifyFailedPodcastImport());
                Log::notice("Email sent...");
                \App\Models\User::findOrFail(1)->notify(new SystemMessagesNotification("Podcast Import Failed. Either the feed is empty, or its format is not currently supported. Notified podcast owner via email."));
            }
        } else {
            Log::error("The feed is empty. Sendind failure email to owner");

            $admin->notify(new NotifyAdminAboutPodcastImport( "The feed with the following url has no content or its content is not compatible: " . $this->feed ));

            Mail::to($this->user_email)->send(new NotifyFailedPodcastImport());
            Log::notice("Send failure email about empty feed to owner...");
            \App\Models\User::findOrFail(1)->notify(new SystemMessagesNotification("Podcast Import Failed. Either the feed is empty, or its format is not currently supported. Notified podcast owner via email."));
        }
    }
}
