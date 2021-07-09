<?php

namespace App\Http\Livewire\Podcast;

use Livewire\Component;
use App\Models\Podcast;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DisplayShows extends Component
{
    public $shows;
    public $favorites;
    public $has_favorites;
    public $query;

    public function render()
    {
        if (!empty($this->query) && Str::length($this->query) >= 3) {
            sleep(.5);
            $this->shows = Podcast::search($this->query)->where('is_public', 'on')->take(10)->get();
        } else {
            $this->shows = Podcast::where('is_public', 'on')->latest()->get();
        }

        if (Auth::check()) {
            $this->favorites = auth()->user()->favorites;
            $this->has_favorites = ( auth()->user()->favorites->count() > 0 ) ? true : false ;
        }

        return view('livewire.podcast.display-shows');
    }
}
