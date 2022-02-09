<?php

namespace App\Http\Livewire\Podcast;

use App\Models\Podcast;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $description;
    public $tags;
    public $lang;
    public $explicit;
    public $style;
    public $thumbnail;
    public $url;
    public $public;
    public $website_style;

    protected $rules = [
        'name' => ['required', 'max:100', 'unique:podcasts,name'],
        'description' => ['required', 'max:1000'],
        'tags' => ['required'],
        'lang' => ['required'],
        'style' => ['required'],
        'thumbnail' => ['required', 'image', 'mimes:png,jpg,webp', 'max:1024'],
        'website_style' => ['required'],
    ];

    public function storePodcast()
    {

        $this->validate();

        $filename = $this->thumbnail->getFileName();
        $this->thumbnail->storeAs('podcasts/covers', $filename);

        $slug = Str::slug($this->name);

        $isExplicit = ($this->explicit == true) ? 'on' : null ;
        $isPublic = ($this->public == true) ? 'on' : null ;

        $podcast = Podcast::create([
            'team_id' => auth()->user()->currentTeam->id,
            'name' => $this->name,
            'slug' => $slug,
            'url' => $this->generatePodcastUrl(),
            'description' => $this->description,
            'tags' => $this->tags,
            'lang' => $this->lang,
            'style' => $this->style,
            'explicit' => $isExplicit,
            'thumbnail' => $filename,
            'is_public' => $isPublic,
            'website_style' => $this->website_style,
        ]);

        session()->flash('flash.banner', 'Podcast successfully created!');
        session()->flash('flash.bannerStyle', 'success');

        return redirect(route('podcasts.show', ['podcast' => $podcast->id]));
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
        $this->url = Str::slug($this->name);
        return view('livewire.podcast.create');
    }
}
