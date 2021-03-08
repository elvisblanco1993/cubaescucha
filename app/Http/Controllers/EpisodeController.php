<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Podcast;
use Illuminate\Http\Request;

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

}
