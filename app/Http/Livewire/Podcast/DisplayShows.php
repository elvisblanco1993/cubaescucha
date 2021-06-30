<?php

namespace App\Http\Livewire\Podcast;

use Livewire\Component;
use App\Models\Podcast;
use Illuminate\Support\Str;

class DisplayShows extends Component
{
    public $shows;
    public $query;

    public function render()
    {
        if (!empty($this->query) && Str::length($this->query) >= 3) {
            sleep(.5);
            $this->shows = Podcast::search($this->query)->where('is_public', true)->take(10)->get();
        } else {
            $this->shows = Podcast::where('is_public', true)->latest()->get();
        }

        return view('livewire.podcast.display-shows');
    }
}
