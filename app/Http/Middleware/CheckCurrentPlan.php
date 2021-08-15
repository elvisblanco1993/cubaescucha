<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Podcast;

class CheckCurrentPlan
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
        if (Podcast::where('team_id', auth()->user()->currentTeam->id)->count() >= 1) {


            if (auth()->user()->subscribed()) {

                return $next($request);

            } else {

                # Redirect to plans
                return redirect()->route('plans.upgrade');

            }

        } else {

            # Continue to publish first podcast
            return $next($request);

        }
    }
}
