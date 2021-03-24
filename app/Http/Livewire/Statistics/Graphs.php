<?php

namespace App\Http\Livewire\Statistics;

use App\Models\Podcast;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Graphs extends Component
{
    public $userPodcasts;
    public $podcast;
    public $mtdCounter;
    public $regions;
    public $reproductions = [];
    public $countPerCountry;
    public $mostPopularEpisode;

    /**
     * Returns the amount of downloads in the current month.
     * This counter reflects total count of downloads among all episodes.
     */
    public function countMonthToDateDownloads()
    {
        return DB::table('downloads_counter')
                    ->where('podcast_id', $this->podcast)
                    ->whereYear('created_at', Carbon::now()->year)
                    ->whereMonth('created_at', Carbon::now()->month)
                    ->count();
    }

    /**
     * Returns the list of countries where people are listening from.
     */
    public function countPerCountry ()
    {
        return DB::table('downloads_counter')
                    ->where('podcast_id', $this->podcast)
                    ->whereYear('created_at', Carbon::now()->year)
                    ->whereMonth('created_at', Carbon::now()->month)
                    ->whereNotNull('country')
                    ->select('country', DB::raw('COUNT(*) as total'))
                    ->groupBy('country')
                    ->orderBy('total', 'DESC')
                    ->limit(10)
                    ->get();
    }

    // Get the most popular episode of always
    public function getMostPopularEpisode()
    {
        return DB::table('downloads_counter')
                    ->join('episodes', 'downloads_counter.episode_id', '=', 'episodes.id')
                    ->where('downloads_counter.podcast_id', $this->podcast)
                    ->select('episodes.title as title', DB::raw('COUNT(*) as total'))
                    ->groupBy('downloads_counter.episode_id')
                    ->orderBy('total', 'DESC')
                    ->get() ?? 0;
    }

    public function render()
    {
        $this->userPodcasts = auth()->user()->podcasts()->orderBy('created_at', 'DESC')->get();
        $this->mtdCounter = $this->countMonthToDateDownloads();
        $this->mostPopularEpisode = $this->getMostPopularEpisode();
        $this->countPerCountry = $this->countPerCountry();

        return view('livewire.statistics.graphs');
    }
}
