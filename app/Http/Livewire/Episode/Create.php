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

    protected $rules = [
        'title' => 'required|max:100',
        'show_notes' => 'required|max:1000',
        'type' => 'required',
        'audio_file' => 'required|file|mimes:mp3',
        'season' => 'required|integer',
        'episode_no' => 'required|integer',
    ];

    public function storeEpisode()
    {
        $this->validate();

        $is_explicit = ($this->explicit = 'on') ? TRUE : FALSE ;

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
            'explicit' => $is_explicit,
            'season' => $this->season,
            'episode_no' => $this->episode_no,
        ]);
        $episode->save();

        // Regenerate podcast rss feed file.
        $this->updateFeed();
        session()->flash('success', 'Your new episode, '.$this->title.', was successfully uploaded and published.');
        return redirect(route('podcasts.show', ['podcast' => $this->podcast->id]));
    }

    private function updateFeed()
    {
        return \App\Http\Controllers\PodcastController::updateRssFeed($this->podcast);
    }

    public function getCurrentSeasonNumber()
    {
        if ($this->podcast->episodes->count() == 0) {
            return $this->podcast->episodes->count() + 1;
        } else {
            return $this->podcast->episodes()->orderBy('created_at', 'DESC')->first()->season;
        }
    }

    public function getCurrentEpisodeNumber()
    {
        if ($this->podcast->episodes->count() == 0) {
            return $this->podcast->episodes->count() + 1;
        } else {
            return $this->podcast->episodes()->orderBy('created_at', 'DESC')->first()->episode_no + 1;
        }
    }

    public function render()
    {

        $this->season = $this->getCurrentSeasonNumber();
        $this->episode_no = $this->getCurrentEpisodeNumber();

        return view('livewire.episode.create');
    }
}
