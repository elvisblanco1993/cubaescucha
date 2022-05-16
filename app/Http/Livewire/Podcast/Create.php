<?php

namespace App\Http\Livewire\Podcast;

use App\Models\Podcast;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Create extends Component
{
    use WithFileUploads;

    public $name, $description, $thumbnail, $tags, $published_at, $style, $explicit, $public;

    protected $rules = [
        'name' => ['required', 'max:100', 'unique:podcasts,name'],
        'description' => ['required', 'max:1000'],
        'tags' => ['required'],
        'style' => ['required'],
        'thumbnail' => ['required', 'image', 'mimes:png,jpg,webp', 'max:2048'],
    ];

    public function updatedThumbnail()
    {
        $this->validate([
            'thumbnail' => 'image|max:2048', // 2MB Max
        ]);
    }

    public function save()
    {
        $this->validate();
        $isExplicit = ($this->explicit == true) ? 'on' : null ;

        try {
            // Upload artwork
            $filename = $this->thumbnail->getFileName();
            $this->thumbnail->storeAs('podcasts/covers', $filename);

            // Create the podcast
            $podcast = Podcast::create([
                'team_id' => auth()->user()->currentTeam->id,
                'name' => $this->name,
                'slug' => Str::slug($this->name),
                'url' => $this->generatePodcastUrl(),
                'description' => $this->description,
                'tags' => $this->tags,
                'style' => $this->style,
                'explicit' => $this->explicit,
                'thumbnail' => $filename,
                'published_at' => ($this->public == true) ? now() : null,
            ]);

            session()->flash('flash.banner', 'Podcast successfully created!');
            session()->flash('flash.bannerStyle', 'success');
        } catch (\Throwable $th) {
            Log::error($th);
            session()->flash('flash.banner', 'There was an error while creating your podast. Please contact support.');
            session()->flash('flash.bannerStyle', 'danger');
        }
        return redirect()->route('podcasts');
    }

    public function render()
    {
        $this->url = Str::slug($this->name);
        return view('livewire.podcast.create');
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
}
