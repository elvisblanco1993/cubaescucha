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
            'podcasts' => Podcast::where('team_id', auth()->user()->currentTeam->id)->orderBy('created_at', 'DESC')->paginate(8)
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
            'thumbnail' => Storage::disk('s3')->url($podcast->thumbnail),
            'episodes' => $podcast->episodes()->get(),
        ]);
    }

    /**
     * Returns similar data as the show() function, but instead faces the end-user.
     */
    public function display($podcast)
    {
        $podcast = Podcast::where('url', $podcast)->first();

        if ($podcast->website_style == 'modern') {
            return view('web.podcast-alt', [
                'podcast_id' => $podcast->id,
                'slug' => $podcast->slug,
                'url' => $podcast->url,
                'name' => $podcast->name,
                'description' => $podcast->description,
                'tags' => $podcast->tags,
                'author' => $podcast->team->name,
                'thumbnail' => Storage::disk('s3')->url($podcast->thumbnail),
                'episodes' => $podcast->episodes()->where('published_at', '<=', Carbon::now())->orderBy('created_at', 'ASC')->get(),
                'spotifypodcasts_url' => $podcast->spotifypodcasts_url,
                'googlepodcasts_url' => $podcast->googlepodcasts_url,
                'applepodcasts_url' => $podcast->applepodcasts_url,
            ]);
        } else {
            return view('web.podcast', [
                'podcast_id' => $podcast->id,
                'slug' => $podcast->slug,
                'url' => $podcast->url,
                'name' => $podcast->name,
                'description' => $podcast->description,
                'tags' => $podcast->tags,
                'author' => $podcast->team->name,
                'thumbnail' => Storage::disk('s3')->url($podcast->thumbnail),
                'episodes' => $podcast->episodes()->where('published_at', '<=', Carbon::now())->orderBy('created_at', 'ASC')->get(),
                'spotifypodcasts_url' => $podcast->spotifypodcasts_url,
                'googlepodcasts_url' => $podcast->googlepodcasts_url,
                'applepodcasts_url' => $podcast->applepodcasts_url,
            ]);
        }

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
            $bytes += Storage::disk('s3')->size($episode->file_name);
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
}
