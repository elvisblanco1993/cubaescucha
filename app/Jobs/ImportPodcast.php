<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Podcast;
use App\Models\Episode;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ImportPodcast implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    public $feed;
    public $podcast_url;
    public $user_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($rss_url, $podcast_url, $user_id)
    {
        $this->feed = $rss_url;
        $this->podcast_url = $podcast_url;
        $this->user_id = $user_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::notice("/---------------------------------------------");
        Log::notice("/ NEW JOB: IMPORT PODCAST [" . $this->feed . "]");
        Log::notice("/---------------------------------------------");

        $feed = simplexml_load_file($this->feed);

        if (!empty($feed)) {

            // Gets the metadata from the RSS URL
            $podcast_name = $feed->channel->title;
            $podcast_description = strip_tags($feed->channel->description);
            $podcast_lang = $feed->channel->language;
            $podcast_tags = $feed->xpath("//itunes:category")[0]['text'];
            $podcast_type = $feed->xpath("//itunes:type")[0];
            $podcast_explicit = ($feed->xpath("//itunes:explicit")[0] == 'yes' || $feed->xpath("//itunes:explicit")[0] == TRUE) ? 1 : 0;
            $podcast_thumbnail = $feed->channel->image->url;

            // Store thumbnail on s3
            $thumbnail_contents = file_get_contents($podcast_thumbnail);
            $thumbnail_name = substr(substr($podcast_thumbnail, strrpos($podcast_thumbnail, '/') + 1), 0, strpos(substr($podcast_thumbnail, strrpos($podcast_thumbnail, '/') + 1), '?'));
            Storage::disk('s3')->put('podcasts/covers/'.$thumbnail_name, $thumbnail_contents, 'public');

            // Create Podcast
            $podcast = Podcast::create([
                'user_id' => $this->user_id,
                'name' => $podcast_name,
                'slug' => Str::slug($podcast_name),
                'url' => $this->podcast_url,
                'description' => $podcast_description,
                'tags' => $podcast_tags,
                'lang' => $podcast_lang,
                'style' => $podcast_type,
                'explicit' => $podcast_explicit,
                'thumbnail' => 'podcasts/covers/'.$thumbnail_name,
            ]);


            // Import episodes
            if ($podcast && $feed->channel->item->count() > 0) {

                Log::notice("Got episodes. Lets check if they are enumerated.");

                // Order episodes with older first, newer last
                if (empty($feed->channel->item->xpath("//itunes:episode")) == TRUE) {

                    Log::notice("Episodes not enumerated. Determining auto generated episode numbers sorting.");

                    // Get the first episode
                    $first = $feed->channel->item[$feed->channel->item->count() -1]->pubDate;
                    // Get the last episode
                    $last = $feed->channel->item[$feed->channel->item->count() -1]->pubDate;

                    $first_pubdate = Carbon::createFromTimestamp(strtotime($first));
                    $last_pubdate = Carbon::createFromTimestamp(strtotime($last));

                    $order_result = $first_pubdate->lt($last_pubdate);

                    // If the first date is less than the second one, then episode counter should start as 1, 2, 3...
                    // Otherwise, the episode counter starts backwards as 30, 29, 28...
                    if ($order_result == TRUE) {
                        $constructed_no = $feed->channel->item->count();
                    } else {
                        $constructed_no = 1;
                    }
                }

                Log::notice("Done checking if episodes are enumerated. Start creating episodes.");

                // Get metadata information from each episode
                foreach ($feed->channel->item as $episode) {

                    $episode_title = $episode->title;
                    $episode_description = $episode->xpath("./itunes:summary")[0];
                    $episode_pubDate = Carbon::createFromTimestamp(strtotime($episode->pubDate))->toDateTimeString();
                    $episode_type = $episode->episodeType;
                    $episode_number = $episode->xpath("./itunes:episode")[0] ?? $constructed_no;
                    $episode_duration = $episode->xpath("./itunes:duration")[0];
                    $episode_url = $episode->enclosure['url'];
                    $episode_explicit = $episode->xpath("./itunes:explicit")[0];
                    $episode_length = $episode->enclosure['length'];
                    $episode_filetype = $episode->enclosure['type'];

                    Log::notice("Grabbed episode data");

                    // Import the episode media file to s3
                    $file_contents = file_get_contents($episode_url);
                    $file_name = 'podcasts/episodes/'. uniqid() . '.' . substr(pathinfo($episode_url, PATHINFO_EXTENSION), 0, strpos(pathinfo($episode_url, PATHINFO_EXTENSION), "?"));

                    Storage::disk('s3')->put($file_name, $file_contents, 'public');
                    Log::notice("Saved to s3");

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

                    if (empty($episode->xpath("./itunes:episode") == TRUE)) {
                        if ($order_result == TRUE) {
                            $constructed_no--;
                        } else {
                            $constructed_no++;
                        }
                    }
                }
            }
        }
    }
}
