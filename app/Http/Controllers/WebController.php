<?php

namespace App\Http\Controllers;

use App\Models\Podcast;

class WebController extends Controller
{
    /**
     * Homepage
     * @returns View
     * @params Podcast
     */
    public function home()
    {
        $podcastsList = Podcast::orderBy('created_at', 'DESC')->simplePaginate(8);

        return view('web.home', [
            'podcastsList' => $podcastsList,
        ]);
    }

    /**
     * Help and Support
     * @returns View
     */
    public function help()
    {
        return view('web.help');
    }

    /**
     * Donation Page
     * @returns View
     */
    public function donate()
    {
        return view('web.donate');
    }

    /**
     * Display the available patron plans
     */
    public function patronPlans()
    {
        return view('web.patron-plans');
    }
}
