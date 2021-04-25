<?php

namespace App\Http\Controllers;

use App\Models\Podcast;

class WebController extends Controller
{
    // Home page
    public function home()
    {
        $podcastsList = Podcast::orderBy('created_at', 'DESC')->paginate(16);

        return view('web.home', [
            'podcastsList' => $podcastsList,
        ]);
    }
}
