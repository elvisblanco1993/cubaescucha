<?php

namespace App\Http\Livewire\Podcast;

use App\Models\Podcast;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Carbon\Carbon;

use function PHPUnit\Framework\isEmpty;

class Reports extends Component
{
    public $podcast;
    public $dateRangeFilter;
    public $dateFrom = null;
    public $dateTo = null;

    public $getMtdDailyReproductions;
    public $reproductionsByEpisode;
    public $totalPlaySevenDaysAfter;
    public $totalPlayThirtyDaysAfter;
    public $totalPlaySixtyDaysAfter;
    public $totalPlayNinetyDaysAfter;

    public function mount($podcast)
    {
        $this->podcast = Podcast::find($podcast);
    }

    // Get Month-To-Date Daily Reproductions
    public function getMtdDailyReproductions()
    {
        $from = (isset($this->dateFrom)) ? date('Y-m-d' . ' 00:00:00', strtotime($this->dateFrom)) : Carbon::now();
        $to = (isset($this->dateTo)) ? date('Y-m-d' . ' 23:59:00', strtotime($this->dateTo)) : Carbon::now();

        return DB::table('downloads_counter')
                ->select(DB::raw('count(*) as total, created_at, country'))
                ->where('podcast_id', $this->podcast->id)
                ->where('created_at', '>=', $from)
                ->where('created_at', '<=', $to)
                ->groupBy('created_at')
                ->groupBy('country')
                ->get();

    }

    // Get Reproductions by Episode
    public function reproductionsByEpisode()
    {
        return DB::table('downloads_counter')
                    ->join('episodes', 'downloads_counter.episode_id', '=', 'episodes.id')
                    ->select('episodes.title as title', 'episodes.created_at as published', DB::raw('COUNT(*) as total'))
                    ->groupBy('downloads_counter.episode_id')
                    ->orderBy('total', 'DESC')
                    ->get();
    }

    // Get total reproductions 7 days after episode is published
    public function totalPlaySevenDaysAfter()
    {
        $total = 0;

        foreach ($this->podcast->episodes as $episode) {
            $total += DB::table('downloads_counter')
                        ->where('episode_id', $episode->id)
                        ->whereBetween('created_at', [Carbon::createFromFormat('Y-m-d H:i:s', $episode->created_at), Carbon::createFromFormat('Y-m-d H:i:s', $episode->created_at)->addDays(7)])
                        ->count();
        }

        return $total;
    }

    // Get total reproductions 30 days after episode is published
    public function totalPlayThirtyDaysAfter()
    {
        $total = 0;

        foreach ($this->podcast->episodes as $episode) {
            $total += DB::table('downloads_counter')
                        ->where('episode_id', $episode->id)
                        ->whereBetween('created_at', [Carbon::createFromFormat('Y-m-d H:i:s', $episode->created_at), Carbon::createFromFormat('Y-m-d H:i:s', $episode->created_at)->addDays(30)])
                        ->count();
        }

        return $total;
    }

    // Get total reproductions 60 days after episode is published
    public function totalPlaySixtyDaysAfter()
    {
        $total = 0;

        foreach ($this->podcast->episodes as $episode) {
            $total += DB::table('downloads_counter')
                        ->where('episode_id', $episode->id)
                        ->whereBetween('created_at', [Carbon::createFromFormat('Y-m-d H:i:s', $episode->created_at), Carbon::createFromFormat('Y-m-d H:i:s', $episode->created_at)->addDays(60)])
                        ->count();
        }

        return $total;
    }

    // Get total reproductions 90 days after episode is published
    public function totalPlayNinetyDaysAfter()
    {
        $total = 0;

        foreach ($this->podcast->episodes as $episode) {
            $total += DB::table('downloads_counter')
                        ->where('episode_id', $episode->id)
                        ->whereBetween('created_at', [Carbon::createFromFormat('Y-m-d H:i:s', $episode->created_at), Carbon::createFromFormat('Y-m-d H:i:s', $episode->created_at)->addDays(90)])
                        ->count();
        }

        return $total;
    }



    public function render()
    {
        $this->getMtdDailyReproductions = $this->getMtdDailyReproductions();
        $this->reproductionsByEpisode = $this->reproductionsByEpisode();
        $this->totalPlaySevenDaysAfter = $this->totalPlaySevenDaysAfter();
        $this->totalPlayThirtyDaysAfter = $this->totalPlayThirtyDaysAfter();
        $this->totalPlaySixtyDaysAfter = $this->totalPlaySixtyDaysAfter();
        $this->totalPlayNinetyDaysAfter = $this->totalPlayNinetyDaysAfter();
        // dd(
        //     $this->totalReproductionsSevenDaysAfterPublished()
        // );
        return view('livewire.podcast.reports');
    }
}
