<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Podcast;

class CheckSubscriptionStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        // User out of trial
        if (!$user->onTrial()) {
            // User is subscribed?
            if ($user->subscribed()) {
                if ($user->subscription()->hasIncompletePayment()) {
                    return redirect()->route('cashier.payment', $user->subscription()->latestPayment()->id);
                } else {
                    return $next($request);
                }
            } else { // Not subscribed
                // Redirect to plans
                return redirect()->route('plans.upgrade');
            }
        } else {
            // User on trial
            return $next($request);
        }
    }
}
