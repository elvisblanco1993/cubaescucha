<?php

use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\PodcastController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Homepage
 */
Route::get('/', [WebController::class, 'home'])->name('home');

/**
 * Podcast webpage
 */
Route::get('/podcast/{podcast}', [PodcastController::class, 'display'])->name('podcast.display');


Route::get('rss/{podcast}', [PodcastController::class, 'setRss'] )->name('set-rss');

/**
 * --------------------------------------------------------------
 * Protected routes
 * --------------------------------------------------------------
 *
 * Here is where you can register all the protected routes.
 * Protected routes are any routes that require a user login.
 */
Route::middleware(['auth:sanctum', 'verified'])->group( function() {

    // Dashboard
    Route::view('/dashboard', 'dashboard')->name('dashboard');

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

});


