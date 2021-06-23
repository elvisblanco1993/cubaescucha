<?php

use App\Http\Controllers\DonationController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\PodcastController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebController;
use App\Http\Livewire\Podcast\Reports;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// PHPINFO
Route::get('/info', function () {
    return phpinfo();
});

/**
 * Homepage
 */
Route::get('/', [WebController::class, 'home'])->name('home');

/**
 * Podcast webpage
 */
Route::get('/podcast/{podcast}', [PodcastController::class, 'display'])->name('podcast.display');

/**
 * Podcast RSS Feed
 */
Route::get('/podcast/{podcast}/rss', [PodcastController::class, 'generateRss'])->name('genRss');

/**
 * Podcast episode page
 */
Route::get('/podcast/{podcast}/{episode}', [EpisodeController::class, 'display'])->name('episode.display');

/**
 * Q&A and Support
 */
Route::get('/help', [WebController::class, 'help'])->name('help');

/**
 * Donations page
 */
Route::get('/donate', [WebController::class, 'donate'])->name('donate');

/**
 * --------------------------------------------------------------
 * Protected routes
 * --------------------------------------------------------------
 *
 * Here is where you can register all the protected routes.
 * Protected routes are any routes that require a user login.
 */
Route::middleware(['auth:sanctum', 'verified'])->group( function() {

    // Show list of podcasts (one team can have many podcasts)
    Route::get('/podcasts', [PodcastController::class, 'index'])->name('podcasts');

    // Show podcast details
    Route::get('/podcasts/{podcast}/details', [PodcastController::class, 'show'])->name('podcasts.show');

    // Edit podcast details
    Route::get('/podcasts/{podcast}/edit', [PodcastController::class, 'edit'])->name('podcasts.edit');

    // Create new podcast
    Route::get('/podcasts/create', [PodcastController::class, 'create'])->name('podcasts.create');

    // Create new episode
    Route::get('/podcasts/{podcast}/episode/create', [EpisodeController::class, 'create'])->name('episode.create');

    // View episode details
    Route::get('/podcasts/{podcast}/episode/{episode}/details', [EpisodeController::class, 'show'])->name('episode.show');

    // Podcast Reports
    Route::get('/podcasts/{podcast}/reports', Reports::class)->name('podcast.reports');

    // Export Total Episodes Reproductions
    Route::get('/podcasts/{podcast}/export_episodes_count_to_csv', [PodcastController::class, 'exportByEpisode'])->name('export-by-episode');
    Route::get('/podcasts/{podcast}/export_countries_count_to_csv', [PodcastController::class, 'exportByCountry'])->name('export-by-country');

    // Go to customer billing portal
    Route::get('/billing-portal', function (Request $request) {
        return $request->user()->redirectToBillingPortal();
    })->name('billing-portal');

    // New patrons subscription page
    // Route::get('/donate/become-a-patron', [WebController::class, 'patronPlans'])->name('patron.plans');
    Route::get('/donate/become-a-patron', function () {
        return redirect(route('donate'));
    })->name('patron.plans');

    /**
     * Generate URL and Redirect to Stripe Checkout
     */
    Route::get('/donate/sponsorship/{tier}', [DonationController::class, 'redirectToCheckout'])->name('checkout');
    Route::get('/donate/success', [DonationController::class, 'confirmDonation'])->name('donate.success');
});


/**
 * ---------------------------------------------------------------------
 * Administrator-only routes
 * ---------------------------------------------------------------------
 *
 * Here is where all the administration of the platform takes place.
 * Administrators can view and impersonate all other users,
 * work with articles, solve technical issues and more.
 */

 Route::middleware(['auth:sanctum', 'verified', 'admin'])->group( function() {

    // Show Users
    Route::get('/users', [UserController::class, 'index'])->name('users');
 });
