<?php

namespace App\Http\Livewire\Podcast;

use Illuminate\Support\Facades\Log;
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
    public $spotifypodcasts_url;
    public $googlepodcasts_url;
    public $applepodcasts_url;
    public $confirmDeleteDialog;
    public $website_style;
    public $public;

    protected $rules = [
        'name' => 'required',
        'description' => 'required',
        'tags' => ['required'],
        'website_style' => ['required'],
    ];


    // Save Podcast
    public function save()
    {
        $this->validate();

        $isExplicit = ($this->explicit == true) ? 'on' : null ;
        $isPublic = ($this->public == true) ? 'on' : null ;

        $this->podcast->update([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'description' => $this->description,
            'tags' => $this->tags,
            'lang' => $this->lang,
            'style' => $this->style,
            'explicit' => $isExplicit,
            'spotifypodcasts_url' => $this->spotifypodcasts_url,
            'googlepodcasts_url' => $this->googlepodcasts_url,
            'applepodcasts_url' => $this->applepodcasts_url,
            'is_public' => $isPublic,
            'website_style' => $this->website_style,
        ]);

        if ($this->thumbnail) {
            // Validate audio file complies with requisites
            $this->validate([
                'thumbnail' => ['required', 'image', 'mimes:png,jpg,webp', 'max:10240']
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

        session()->flash('flash.banner', 'All changes were successfully saved!');
        session()->flash('flash.bannerStyle', 'success');

        return redirect(route('podcasts.show', ['podcast' => $this->podcast->id]));
    }

    // Delete Podcast
    public function deletePodcast()
    {
        if (auth()->user()->hasTeamRole( auth()->user()->currentTeam, 'admin' )) {

            foreach ($this->podcast->episodes as $episode) {
                // Delete episode files
                Storage::disk('s3')->delete($episode->file_name);

                // Delete episodes from DB
                $episode->delete();
            }

            // Delete podcast thumbnail image
            Storage::disk('s3')->delete($this->podcast->thumbnail);

            // Delete podcast
            $this->podcast->delete();

            session()->flash('flash.banner', 'The podcast ' . $this->podcast->name . ', and all its content has been successfully deleted from our platform!');
            session()->flash('flash.bannerStyle', 'success');

            return redirect(route('podcasts'));

        } else {
            Log::error("A user tried to delete a podcast - User: " . auth()->user()->name . " - Podcast: " . $this->podcast->name);
            abort(503, 'Unauthorized action. This will be reported!');
        }
    }

    public function render()
    {
        $this->name = $this->podcast->name;
        $this->description = $this->podcast->description;
        $this->tags = $this->podcast->tags;
        $this->explicit = $this->podcast->explicit;
        $this->public = $this->podcast->is_public;
        $this->lang = $this->podcast->lang;
        $this->style = $this->podcast->style;
        $this->spotifypodcasts_url = $this->podcast->spotifypodcasts_url;
        $this->googlepodcasts_url = $this->podcast->googlepodcasts_url;
        $this->applepodcasts_url = $this->podcast->applepodcasts_url;
        $this->website_style = $this->podcast->website_style;
        return view('livewire.podcast.edit');
    }
}
