<?php

namespace App\Http\Controllers;

use App\Models\Podcast;
use Illuminate\Http\Request;

class WebController extends Controller
{
    // Home page
    public function home()
    {
        $podcastsList = Podcast::all();

        return view('web.home', [
            'podcastsList' => $podcastsList,
        ]);
    }
}
