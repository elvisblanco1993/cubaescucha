<?php

namespace App\Http\Livewire\Podcast;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Follow extends Component
{
    public $following;
    public $user_id;
    public $podcast_id;

    public function mount()
    {
        $this->following = (DB::table('following')->where('user_id', $this->user_id)->where('podcast_id', $this->podcast_id)->count() == 1) ? true : false;
    }

    public function follow()
    {
        if ($this->following == false) {
            DB::table('following')->insert(['user_id' => $this->user_id, 'podcast_id' => $this->podcast_id]);
            $this->following = true;
        } else {
            DB::table('following')->where('user_id', $this->user_id)->where('podcast_id', $this->podcast_id)->delete();
            $this->following = false;
        }
    }

    public function render()
    {
        return view('livewire.podcast.follow');
    }
}
