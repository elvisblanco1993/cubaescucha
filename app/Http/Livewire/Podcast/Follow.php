<?php

namespace App\Http\Livewire\Podcast;

use App\Models\User;
use Livewire\Component;

class Follow extends Component
{
    public $following;
    public $user_id;
    public $podcast_id;

    public function mount()
    {
        $this->following = User::findOrFail(auth()->user()->id)->favorites->contains($this->podcast_id); // returns boolean
    }

    public function follow()
    {
        if ($this->following == false) {
            User::findOrFail(auth()->user()->id)->favorites()->attach($this->podcast_id);
            $this->following = true;
        } else {
            User::findOrFail(auth()->user()->id)->favorites()->detach($this->podcast_id);
            $this->following = false;
        }
    }

    public function render()
    {
        return view('livewire.podcast.follow');
    }
}
