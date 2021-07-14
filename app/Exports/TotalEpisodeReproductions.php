<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class TotalEpisodeReproductions implements FromCollection
{
    public function __construct($podcast)
    {
        $this->podcast = $podcast;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        return DB::table('downloads_counter')
                    ->join('episodes', 'downloads_counter.episode_id', '=', 'episodes.id')
                    ->select('episodes.title as title', 'episodes.created_at as published', DB::raw('COUNT(*) as total'))
                    ->where('downloads_counter.podcast_id', $this->podcast)
                    ->groupBy('downloads_counter.episode_id')
                    ->orderBy('total', 'DESC')
                    ->get();
    }
}
