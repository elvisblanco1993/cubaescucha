<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class DonationController extends Controller
{
    /**
     * Redirect to Stripe Checkout
     */
    public function redirectToCheckout($tier)
    {
        if ($tier >= 1 && $tier <=4) {
            switch ($tier) {
                case '1':
                    $pricing = config('donations.monthly_price_5');
                    $total = '5';
                    break;
                case '2':
                    $pricing = config('donations.monthly_price_15');
                    $total = '15';
                    break;
                case '3':
                    $pricing = config('donations.monthly_price_25');
                    $total = '25';
                    break;
                case '4':
                    $pricing = config('donations.monthly_price_50');
                    $total = '50';
                    break;

                default:

                    break;
            }

            $checkout = Auth::user()->newSubscription('default', $pricing)->checkout([
                'success_url' => route('donate.success'),
                'cancel_url' => route('donate'),
            ]);

            return view('web.donate.checkout', [
                'checkout' => $checkout,
                'total' => $total,
            ]);

        } else {
            Log::notice("Someone is trying to access a donation action that is not available.");
        }
    }

    /**
     * Confirms the payment succeeded to the sponsor
     */
    public function confirmDonation()
    {
        return view('web.donate', [
            'success' => 'Thank you for sponsoring cubaescucha.com! Your name will be highlighted in our sponsors list.'
        ]);
    }
}
