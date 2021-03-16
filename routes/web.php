<?php

use App\Exports\PodcastStatsExport;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\PodcastController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;

/**
 * Homepage
 */
Route::get('/', [WebController::class, 'home'])->name('home');

/**
 * Podcast webpage
 */
Route::get('/podcast/{podcast}', [PodcastController::class, 'display'])->name('podcast.display');



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

    // Export Podast Views
    Route::get('podcast-stats-export/{podcast}', [PodcastController::class, 'fileExport'])->name('podcast-stats-export');

    // Update RSS Feed
    Route::get('rss/{podcast}/update', [PodcastController::class, 'updateRssFeed'] )->name('set-rss');
});


