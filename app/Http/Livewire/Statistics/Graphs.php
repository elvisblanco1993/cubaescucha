<?php

namespace App\Http\Livewire\Statistics;

use App\Models\Podcast;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Graphs extends Component
{
    public $userPodcasts;
    public $podcastQuery;
    public $mtdCounter;
    public $regions;
    public $reproductions = [];
    public $countPerCountry;
    public $podcastInfo;

    public function mount()
    {
        if ( empty($this->podcastQuery)) {
            $this->podcastQuery = auth()->user()->podcasts->first()->id ?? '';
        }

        $this->podcastQuery = 3;
    }

    /**
     * Returns the amount of downloads in the current month.
     * This counter reflects total count of downloads among all episodes.
     */
    public function countMonthToDateDownloads()
    {
        return DB::table('downloads_counter')
                    ->where('podcast_id', $this->podcastQuery)
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
                    ->where('podcast_id', $this->podcastQuery)
                    ->whereYear('created_at', Carbon::now()->year)
                    ->whereMonth('created_at', Carbon::now()->month)
                    ->whereNotNull('country')
                    ->select('country', DB::raw('COUNT(*) as total'))
                    ->groupBy('country')
                    ->orderBy('total', 'DESC')
                    ->limit(10)
                    ->get();
    }

    public function podcastInfo () {
        $podcast = Podcast::where('id', $this->podcastQuery)->first();
        return $podcast;
    }

    public function render()
    {
        $this->podcastInfo = $this->podcastInfo();
        $this->userPodcasts = auth()->user()->podcasts;
        $this->mtdCounter = $this->countMonthToDateDownloads();
        $this->countPerCountry = $this->countPerCountry();
        // dd(
        //     $this->countPerCountry
        // );
        return view('livewire.statistics.graphs');
    }
}
