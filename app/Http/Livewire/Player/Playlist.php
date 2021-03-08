<?php

namespace App\Http\Livewire\Player;

use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Episode;
use Stevebauman\Location\Facades\Location;

class Playlist extends Component
{
    public $episodes;
    public $episode;

    protected $listeners = [
        'playing' => 'countReproduction',
    ];

    public function countReproduction(Episode $episode)
    {
        DB::table('downloads_counter')->insert([
            'podcast_id' => $episode->podcast_id,
            'episode_id' => $episode->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'country' => ($position = Location::get()) ? $position->countryName : 'not determined',
        ]);
        $this->emit('continue');
    }

    public function render()
    {
        return view('livewire.player.playlist');
    }
}
