<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;

class PodcastStatsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('downloads_counter')
                    ->where('podcast_id', request()->get('podcast'))
                    ->whereYear('created_at', Carbon::now()->year)
                    ->whereMonth('created_at', Carbon::now()->month)
                    ->whereNotNull('country')
                    ->select('country', DB::raw('COUNT(*) as total'))
                    ->groupBy('country')
                    ->orderBy('total', 'DESC')
                    ->get();
    }
}
