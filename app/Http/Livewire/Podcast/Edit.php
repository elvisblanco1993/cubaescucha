<?php

namespace App\Http\Livewire\Podcast;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Edit extends Component
{
    use WithFileUploads;

    public $podcast;
    public $name;
    public $description;
    public $tags;
    public $lang;
    public $style;
    public $explicit;
    public $thumbnail;

    protected $rules = [
        'name' => 'required',
        'description' => 'required',
        'tags' => ['required'],
    ];

    public function save()
    {
        $this->validate();

        $is_explicit = ($this->explicit = 'on') ? TRUE : FALSE ;

        $this->podcast->update([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'description' => $this->description,
            'tags' => $this->tags,
            'lang' => $this->lang,
            'style' => $this->style,
            'explicit' => $is_explicit,
        ]);

        if ($this->thumbnail) {
            // Validate audio file complies with requisites
            $this->validate([
                'thumbnail' => ['required', 'image', 'mimes:png,jpg,webp', 'max:4096']
            ]);
            // Delete old audio file
            Storage::disk('s3')->delete($this->podcast->thumbnail);
            // Upload new audio file
            $path = $this->thumbnail->store('podcasts/covers', 's3');
            // Make file public
            Storage::disk('s3')->setVisibility($path, 'public');

            // Update audio file on DB
            $this->podcast->update(['thumbnail' => $path]);
        }

        session()->flash('success', 'All changes were successfully saved.');
        return redirect(route('podcasts.show', ['podcast' => $this->podcast->id]));
    }

    public function render()
    {
        $this->name = $this->podcast->name;
        $this->description = $this->podcast->description;
        $this->tags = $this->podcast->tags;
        $this->explicit = $this->podcast->explicit;
        $this->lang = $this->podcast->lang;
        $this->style = $this->podcast->style;
        return view('livewire.podcast.edit');
    }
}
