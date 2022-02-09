<?php

namespace App\Http\Livewire\Episode;

use Carbon\Carbon;
use App\Models\Episode;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Stevebauman\Location\Facades\Location;

class Player extends Component
{

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
        return view('livewire.episode.player');
    }
}
