<?php

namespace App\Http\Livewire\Player\Episode;

use Livewire\Component;
use Carbon\Carbon;
use Stevebauman\Location\Facades\Location;
use App\Models\Episode;
use Illuminate\Support\Facades\DB;

class Play extends Component
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
    }

    public function render()
    {
        return view('livewire.player.episode.play');
    }
}
