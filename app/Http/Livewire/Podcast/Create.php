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
    public $explicit;
    public $thumbnail;
    public $url;
    public $rss;

    protected $rules = [
        'name' => ['required', 'max:100', 'unique:podcasts,name'],
        'description' => ['required', 'max:1000'],
        'tags' => ['required'],
        'thumbnail' => ['required', 'image', 'mimes:png,jpg,webp', 'max:4096'],
        'url' => ['required', 'unique:podcasts,url']
    ];

    public function storePodcast()
    {
        $this->validate();

        $is_explicit = ($this->explicit = 'on') ? TRUE : FALSE ;

        $path = $this->thumbnail->store('podcasts/covers', 's3');

        Storage::disk('s3')->setVisibility($path, 'public');

        $slug = Str::slug($this->name);

        $podcast = Podcast::create([
            'user_id' => auth()->user()->id,
            'name' => $this->name,
            'slug' => $slug,
            'description' => $this->description,
            'tags' => $this->tags,
            'explicit' => $is_explicit,
            'thumbnail' => $path,
            'url' => $this->url,
            'rss' => $this->url.'.xml',
        ]);

        session()->flash('success', 'Your new podcast, ' . $this->name . ', was successfully created!');

        return redirect(route('podcasts.show', ['podcast' => $podcast->id]));
    }

    public function render()
    {
        $this->url = Str::slug($this->name);
        return view('livewire.podcast.create');
    }
}