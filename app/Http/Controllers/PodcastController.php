<?php

namespace App\Http\Controllers;

use App\Models\Podcast;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TotalEpisodeReproductions;
use App\Exports\TotalReproductionsByCountry;
use App\Models\Team;

class PodcastController extends Controller
{

    /**
     * Returns podcast main screen, displaying all episodes.
     */
    public function index()
    {
        return view('podcast.index', [
            'podcasts' => auth()->user()->currentTeam->podcasts
        ]);
    }

    /**
     * Returns a view where the new podcast will be created.
     */
    public function create()
    {
        return view('podcast.create');
    }

    /**
     * Returns a view with podcast details.
     */
    public function show(Podcast $podcast)
    {
        return view('podcast.show', [
            'podcast' => $podcast,
            'thumbnail' => Storage::disk('local')->url($podcast->thumbnail),
            'episodes' => $podcast->episodes()->get(),
        ]);
    }

    /**
     * Returns similar data as the show() function, but instead faces the end-user.
     */
    public function display($podcast)
    {
        $podcast = Podcast::where('url', $podcast)->first();

        return view('web.podcast-alt', [
            'podcast' => $podcast
        ]);
    }

    /**
     * Returns a view where the podcast details can be edited.
     */
    public function edit(Podcast $podcast)
    {
        return view('podcast.edit', ['podcast' => $podcast]);
    }


    public function exportByEpisode(Podcast $podcast)
    {
        return Excel::download(new TotalEpisodeReproductions($podcast->id), 'podcast-statistics.xlsx');
    }

    public function exportByCountry(Podcast $podcast)
    {
        return Excel::download(new TotalReproductionsByCountry($podcast->id), 'podcast-statistics.xlsx');
    }

    public function generateRss ($podcast)
    {
        $podcast = Podcast::where('url', $podcast)->first();
        return response()->view('podcast.rss', ['podcast' => $podcast])->header('Content-Type', 'application/xml');
    }

    /**
     * Get the podcast size;
     */
    public function getPodcastSize(Podcast $podcast) {
        $size = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
        $decimals = 2;
        $bytes = 0;

        foreach ($podcast->episodes as $episode) {
            $bytes += Storage::disk('local')->size($episode->file_name);
        }

        $factor = floor((strlen($bytes) - 1) / 3);

        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . ' ' . $size[$factor];
    }

    /**
     * Import podcast from rss url
     */
    public function import()
    {
        return view('podcast.import');
    }

    /**
     * Reports
     */
    public function reports(Podcast $podcast)
    {
        return view('podcast.reports', [
            'podcast' => $podcast,
        ]);
    }
}
