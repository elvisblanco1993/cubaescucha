<?php

namespace App\Http\Livewire\Episode;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Carbon\Carbon;

class Edit extends Component
{
    use WithFileUploads;

    public $confirmDeleteEpisode = FALSE;
    public $podcast;
    public $episode;
    public $title;
    public $show_notes;
    public $type;
    public $audio_file;
    public $published_at;

    protected $rules = [
        'title' => 'required|max:100',
        'show_notes' => 'required|max:1000',
        'type' => 'required',
    ];

    public function save()
    {
        $this->validate();
        $this->episode->update([
            'title' => $this->title,
            'show_notes' => $this->show_notes,
            'type' => $this->type,
            'published_at' => $this->published_at,
        ]);
        // Validates audio file if is going to be updated
        if ($this->audio_file) {
            // Validate audio file complies with requisites
            $this->validate([
                'audio_file' => 'required|file|mimes:mp3'
            ]);
            // Delete old audio file
            Storage::disk('s3')->delete($this->episode->file_name);
            // Upload new audio file
            $path = $this->audio_file->store('podcasts/episodes', 's3');
            Storage::disk('s3')->setVisibility($path, 'public');
            // Update audio file on DB
            $this->episode->update(['file_name' => $path]);
        }

        session()->flash('flash.banner', 'Episode details successfully updated!');
        session()->flash('flash.bannerStyle', 'success');

        return redirect(route('episode.show', ['podcast'=>$this->podcast->id, 'episode'=>$this->episode->id]));
    }

    /**
     * Delete episode
     */
    public function delete()
    {
        Storage::disk('s3')->delete($this->episode->file_name);
        $this->episode->delete();

        session()->flash('flash.banner', 'Episode successfully deleted!');
        session()->flash('flash.bannerStyle', 'success');

        return redirect(route('podcasts.show', ['podcast'=>$this->podcast->id]));
    }

    public function render()
    {
        $this->title = $this->episode->title;
        $this->show_notes = $this->episode->show_notes;
        $this->type = $this->episode->type;
        $this->published_at = $this->episode->published_at ?? Carbon::now();

        return view('livewire.episode.edit');
    }
}
