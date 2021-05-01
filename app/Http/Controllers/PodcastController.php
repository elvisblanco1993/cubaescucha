<?php

namespace App\Http\Controllers;

use App\Models\Podcast;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TotalEpisodeReproductions;
use App\Exports\TotalReproductionsByCountry;

class PodcastController extends Controller
{

    /**
     * Returns podcast main screen, displaying all episodes.
     */
    public function index()
    {
        return view('podcast.index', [
            'podcasts' => Podcast::where('user_id', auth()->user()->id)->paginate(5)
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
            'publisher' => User::where('id', $podcast->user_id)->first(),
            'thumbnail' => Storage::disk('s3')->url($podcast->thumbnail),
            'episodes' => $podcast->episodes()->orderBy('created_at', 'DESC')->get(),
        ]);
    }

    /**
     * Returns similar data as the show() function, but instead faces the end-user.
     */
    public function display($podcast)
    {
        $podcast = Podcast::where('slug', $podcast)->first();

        return view('web.podcast', [
            'slug' => $podcast->slug,
            'name' => $podcast->name,
            'description' => $podcast->description,
            'tags' => $podcast->tags,
            'author' => User::where('id', $podcast->user_id)->first()->name,
            'thumbnail' => Storage::disk('s3')->url($podcast->thumbnail),
            'episodes' => $podcast->episodes()->where('published_at', '<=', Carbon::now())->orderBy('created_at', 'ASC')->get(),
            'spotifypodcasts_url' => $podcast->spotifypodcasts_url,
            'googlepodcasts_url' => $podcast->googlepodcasts_url,
            'applepodcasts_url' => $podcast->applepodcasts_url,
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
        $podcast = Podcast::where('slug', $podcast)->first();
        return response()->view('podcast.rss', ['podcast' => $podcast])->header('Content-Type', 'application/xml');
    }
}
