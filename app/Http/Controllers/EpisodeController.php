<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Podcast;

class EpisodeController extends Controller
{
    public function create()
    {
        $podcast = Podcast::findOrFail(request()->podcast);

        return view('episodes.create', [
            'podcast' => $podcast,
        ]);
    }

    public function show(Podcast $podcast, Episode $episode)
    {
        return view('episodes.show', [
            'podcast' => $podcast,
            'episode' => $episode,
        ]);
    }

    public function display($podcast, $episode) {
        $podcast = Podcast::where('url', $podcast)->first();
        $episode = Episode::where('uuid', $episode)->first();

        return view('web.episode', [
            'podcast' => $podcast,
            'episode' => $episode,
        ]);
    }

}
