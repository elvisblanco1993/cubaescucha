<?php
use App\Http\Controllers\DocumentationController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\PodcastController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlanController;
use Illuminate\Http\Request;

/**
 * Homepage
 */
Route::get('/', [WebController::class, 'home'])->name('home');

/**
 * List all the published podcasts
 */
Route::get('/shows', [WebController::class, 'listPublishedPodcasts'])->name('shows');

/**
 * Podcast webpage
 */
Route::get('/shows/{podcast}', [PodcastController::class, 'display'])->name('podcast.display');

/**
 * Podcast RSS Feed
 */
Route::get('/shows/{podcast}/rss', [PodcastController::class, 'generateRss'])->name('genRss');

/**
 * Podcast episode page
 */
Route::get('/shows/{podcast}/{episode}', [EpisodeController::class, 'display'])->name('episode.display');

/**
 * Episode get url
 */
Route::get('/shows/{podcast}/episode/{episode}', function($podcast, $episode) {
    $path = storage_path('app/podcasts/episodes/'.$episode);
    return response()->file($path);
})->name('play_episode');

/**
 * Q&A and Support
 */
Route::get('/help', [DocumentationController::class, 'index'])->name('help');

/**
 * View Article
 */
Route::get('/help/{article}', [DocumentationController::class, 'show'])->name('article.view');

/**
 * Pricing options
 */
Route::get('/pricing', [WebController::class, 'pricing'])->name('pricing');

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
    Route::middleware('checksubscription')->get('/podcasts', [PodcastController::class, 'index'])->name('podcasts');

    // Import Podcast from RSS URL
    Route::middleware('checksubscription')->get('/podcasts/import', [PodcastController::class, 'import'])->name('podcasts.import');

    // Show podcast details
    Route::get('/podcasts/{podcast}/details', [PodcastController::class, 'show'])->name('podcasts.show');

    // Edit podcast details
    Route::get('/podcasts/{podcast}/edit', [PodcastController::class, 'edit'])->name('podcasts.edit');

    // Create new podcast
    Route::middleware('checksubscription')->get('/podcasts/create', [PodcastController::class, 'create'])->name('podcasts.create');

    // Create new episode
    Route::get('/podcasts/{podcast}/episode/create', [EpisodeController::class, 'create'])->name('episode.create');

    // View episode details
    Route::get('/podcasts/{podcast}/episode/{episode}/details', [EpisodeController::class, 'show'])->name('episode.show');

    // Podcast Reports
    Route::get('/podcasts/{podcast}/reports', [PodcastController::class, 'reports'])->name('podcast.reports');

    // Export Total Episodes Reproductions
    Route::get('/podcasts/{podcast}/export_episodes_count_to_csv', [PodcastController::class, 'exportByEpisode'])->name('export-by-episode');
    Route::get('/podcasts/{podcast}/export_countries_count_to_csv', [PodcastController::class, 'exportByCountry'])->name('export-by-country');

    // Go to customer billing portal
    Route::get('/billing-portal', function (Request $request) {

        return $request->user()->redirectToBillingPortal(
            route('podcasts')
        );
    })->name('billing-portal');

    // Upgrade To Plan
    Route::get('/plans/upgrade', [PlanController::class, 'index'])->name('plans.upgrade');
    Route::post('/plans/upgrade/{plan}', [PlanController::class, 'charge'])->name('plans.enroll');
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
    Route::get('/teams', [UserController::class, 'index'])->name('teams');
});
