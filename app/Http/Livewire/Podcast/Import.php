<?php

namespace App\Http\Livewire\Podcast;

use App\Jobs\ImportPodcast;
use Livewire\Component;
use App\Models\Podcast;
use Illuminate\Support\Str;

class Import extends Component
{
    public $url;
    public $importDialog;
    public $agree;

    protected $rules = [
        'url' => ['required', 'url'],
        'agree' => ['required', 'string']
    ];

    public function import()
    {
        $this->validate();

        ImportPodcast::dispatch($this->url, $this->generatePodcastUrl(), auth()->user()->id, auth()->user()->email);

        session()->flash('success', 'We are processing your podcast and will email you when is ready.');
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

    public function render()
    {
        return view('livewire.podcast.import');
    }
}
