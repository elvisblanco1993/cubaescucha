<?php

namespace App\Http\Livewire\Episode;

use App\Jobs\NewEpisodeUploaded;
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
    public $audio_duration;
    public $publish = false;
    public $publish_date;
    public $publish_hour;
    public $publish_minute;
    public $notify_subscribers;


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

    public function makeFutureDate()
    {
        $year = date('Y', strtotime($this->publish_date));
        $month = date('m', strtotime($this->publish_date));
        $day = date('d', strtotime($this->publish_date));
        $hour = $this->publish_hour;
        $minute = $this->publish_minute;
        $publish_on = Carbon::create($year, $month, $day, $hour, $minute, 0, null);

        return ($this->publish == true) ? $publish_on : Carbon::now();
    }

    /**
     * Create new episode
     */
    public function storeEpisode()
    {
        $this->validate();

        $is_explicit = ($this->explicit == true) ? 'on' : null;

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
            'published_at' => ($this->publish == false) ? Carbon::now() : $this->makeFutureDate(),
        ]);
        $episode->save();

        // Notify podcast followers about the new episode release.
        if ($this->notify_subscribers == true) {
            NewEpisodeUploaded::dispatch(
                $this->podcast,
                $this->title,
            );
        }

        session()->flash('flash.banner', 'Episode successfully created!');
        session()->flash('flash.bannerStyle', 'success');

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

    public function enablePublishOption()
    {
        $this->publish = ($this->publish == false) ? true : false;
    }

    public function render()
    {
        $this->season = $this->getCurrentSeasonNumber();
        $this->episode_no = $this->getCurrentEpisodeNumber();
        return view('livewire.episode.create');
    }
}
