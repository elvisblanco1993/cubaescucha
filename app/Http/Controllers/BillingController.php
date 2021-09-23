<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillingController extends Controller
{
    public function index() {
        $checkoutPlan1 = Auth::user()->currentTeam->checkout('price_123', [
            'success_url' => route('dashboard'),
            'cancel_url' => route('dashboard'),
            'mode' => 'subscription',
            'allow_promotion_codes' => true
        ]);
        $checkoutPlan2 = Auth::user()->currentTeam->checkout('price_456', [
            'success_url' => route('dashboard'),
            'cancel_url' => route('dashboard'),
            'mode' => 'subscription',
            'allow_promotion_codes' => true
        ]);

        return view('billing', ['checkout1' => $checkoutPlan1, 'checkout2' => $checkoutPlan2]);
    }
}
