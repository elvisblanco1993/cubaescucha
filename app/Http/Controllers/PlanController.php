<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        return view('plans.index');
    }

    public function charge()
    {
        $checkout = auth()->user()->checkout('price_1JOCy5BDtpph984XpQ3tAhAd', [
            'success_url' => route('podcasts'),
            'cancel_url' => route('podcasts'),
            'mode' => 'subscription'
        ]);

        return redirect()->to($checkout->url);
    }
}
