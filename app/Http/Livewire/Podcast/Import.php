<?php

namespace App\Http\Livewire\Podcast;

use App\Jobs\ImportPodcast;
use App\Mail\ConfirmRssFeedOwnershipEmail;
use Livewire\Component;
use App\Models\Podcast;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class Import extends Component
{
    public $url;
    public $importDialog;
    public $step = 0;

    public $podcast_name, $podcast_description, $podcast_owner_email, $podcast_thumbnail, $episodes_count, $data;

    public $code, $validation_code;

    public function import()
    {
        $this->validate([
            'url' => 'required|url',
        ]);

        if ($this->validation_code != $this->code) {
            Log::error("Code validation failed");
        }

        ImportPodcast::dispatch($this->url, $this->generatePodcastUrl(), auth()->user()->currentTeam->id, auth()->user()->email)->onQueue('import_podcasts');

        session()->flash('flash.banner', 'We are processing your podcast and will email you when is ready.');
        session()->flash('flash.bannerStyle', 'success');
        return redirect()->to('/podcasts');

    }

    /**
     * Generates an unique url identified for the podcast
     * @param null
     * @return $uniqueId
     */
    protected function generatePodcastUrl()
    {
        $uniqueId = Str::random(8);
        while (Podcast::where('url', $uniqueId)->exists()) {
            $uniqueId = Str::random(8);
        }
        return $uniqueId;
    }

    /**
     * Get RSS feed URL information and display it for user confirmation
     */
    public function verifyPodcast()
    {
        $this->validate([
            'url' => 'required|url'
        ]);

        try {
            $feed = simplexml_load_file($this->url);
        } catch (\Throwable $e) {
            Log::error("Failed to load remote feed: " . $e->getMessage());
        }

        if (!empty($feed)) {

            $this->podcast_name = $feed->channel->title->__toString();
            $this->podcast_description = strip_tags($feed->channel->description->__toString());
            $this->podcast_owner_email = $feed->xpath("//itunes:owner//itunes:email")[0]->__toString();
            $this->podcast_thumbnail = ( $feed->channel->image->url ) ? $feed->channel->image->url->__toString() : $feed->xpath("//itunes:image")[0]['href']->__toString();
            $this->episodes_count = $feed->channel->item->count();
            $episodes = $feed->channel->item;

            foreach ($episodes as $episode) {
                $this->data[] = [
                    'title' => $episode->title->__toString(),
                    'pubDate' => date('D M d, Y', strtotime($episode->pubDate->__toString()))
                ];
            }

            $this->data = array_slice($this->data,0, 10);
        }

        $this->step = 1;
        return view('livewire.podcast.import.verify');
    }

    /**
     * Confirm rss feed ownership via email
     */
    public function confirmOwnership()
    {
        $this->code = Str::random(8);

        Mail::to($this->podcast_owner_email)->send(new ConfirmRssFeedOwnershipEmail($this->code));

        $this->step = 2;
        return view('livewire.podcast.import.confirm');
    }

    public function render()
    {
        switch ($this->step) {
            // Enter rss feed url
            case 0:
                return view('livewire.podcast.import.start');
                break;

            // Confirm selection
            case 1:
                return view('livewire.podcast.import.verify');
                break;

            // Send email and verify with code
            case 2:
                return view('livewire.podcast.import.confirm');
                break;

            // Enter rss feed url
            default:
                return view('livewire.podcast.import.start');
                break;
        }
    }
}
