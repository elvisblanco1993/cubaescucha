<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        return view('plans.index');
    }

    public function charge($plan)
    {
        switch ($plan) {
            case 'monthly':
                $price = config('plans.monthly');
                break;

            case 'annual':
                $price = config('plans.annual');
                break;

            default:
                return redirect()->route('plans.upgrade');
                break;
        }

        $checkout = auth()->user()->checkout($price, [
            'success_url' => route('podcasts'),
            'cancel_url' => route('podcasts'),
            'mode' => 'subscription',
            'allow_promotion_codes' => true
        ]);

        return redirect()->to($checkout->url);
    }
}
