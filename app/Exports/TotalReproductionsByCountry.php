<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class TotalReproductionsByCountry implements FromCollection
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
        return DB::table('downloads_counter')
                    ->where('podcast_id', $this->podcast)
                    ->whereYear('created_at', Carbon::now()->year)
                    ->whereMonth('created_at', Carbon::now()->month)
                    ->whereNotNull('country')
                    ->select('country', DB::raw('COUNT(*) as total'))
                    ->groupBy('country')
                    ->orderBy('total', 'DESC')
                    ->get();
    }
}
