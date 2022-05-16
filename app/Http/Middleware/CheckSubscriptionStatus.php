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
        if (!$user->currentTeam->onTrial()) {
            // User is subscribed?
            if ($user->currentTeam->subscribed()) {
                if ($user->currentTeam->subscription()->hasIncompletePayment()) {
                    return redirect()->route('cashier.payment', $user->currentTeam->subscription()->latestPayment()->id);
                } else {
                    return $next($request);
                }
            } else { // Not subscribed
                // Redirect to plans
                return redirect()->route('plans.upgrade');
            }
        } else {
            return $next($request);
        }
    }
}
