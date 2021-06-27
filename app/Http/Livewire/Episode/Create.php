<?php

namespace App\Http\Livewire\Episode;

use App\Models\Episode;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class Create extends Component
{
    use WithFileUploads;

    public $title;
    public $show_notes;
    public $type;
    public $audio_file;
    public $podcast;
    public $explicit;
    public $season;
    public $episode_no;
    public $published_at;
    public $audio_duration;

    protected $rules = [
        'title' => 'required|max:100',
        'show_notes' => 'required|max:1000',
        'type' => 'required',
        'audio_file' => 'required|file|mimes:mp3',
        'episode_no' => 'required|integer',
        'audio_duration' => 'required',
    ];

    /**
     * Listens for Javascript events
     */
    protected $listeners = ['getAudioDuration'];

    /**
     * Grab the audio duration upon temporarily uploading the file.
     */
    public function getAudioDuration($duration)
    {
        $this->audio_duration = $duration;
    }

    /**
     * Create new episode
     */
    public function storeEpisode()
    {

        $this->validate();

        $is_explicit = ($this->explicit == 'on') ? TRUE : FALSE ;

        $path = $this->audio_file->store('podcasts/episodes', 's3');
        Storage::disk('s3')->setVisibility($path, 'public');

        $episode = new Episode([
            'uuid' => strtotime(Carbon::now()),
            'podcast_id' => $this->podcast->id,
            'title' => $this->title,
            'show_notes' => $this->show_notes,
            'type' => $this->type,
            'downloadable' => true,
            'file_name' => $path,
            'audio_duration' => ceil($this->audio_duration),
            'explicit' => $is_explicit,
            'season' => ($this->podcast->style == 'ews') ? $this->season : null , // Only insert season number if the podcast has seasons
            'episode_no' => $this->episode_no,
            'published_at' => $this->published_at,
        ]);
        $episode->save();

        session()->flash('success', 'Your new episode, '.$this->title.', was successfully uploaded and published.');
        return redirect(route('podcasts.show', ['podcast' => $this->podcast->id]));
    }

    public function getCurrentSeasonNumber()
    {
        if ($this->podcast->episodes->count() == 0) {
            return $this->podcast->episodes->count() + 1;
        } else {
            return $this->podcast->episodes()->orderBy('episode_no', 'DESC')->first()->season;
        }
    }

    public function getCurrentEpisodeNumber()
    {
        if ($this->podcast->episodes->count() == 0) {
            return $this->podcast->episodes->count() + 1;
        } else {
            return $this->podcast->episodes()->orderBy('episode_no', 'DESC')->first()->episode_no + 1;
        }
    }

    public function render()
    {
        $this->season = $this->getCurrentSeasonNumber();
        $this->episode_no = $this->getCurrentEpisodeNumber();
        $this->published_at ??= Carbon::now();

        return view('livewire.episode.create');
    }
}
