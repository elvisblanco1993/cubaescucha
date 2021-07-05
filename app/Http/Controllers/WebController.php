<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use App\Models\Podcast;
use App\Notifications\SystemMessagesNotification;

class WebController extends Controller
{
    /**
     * Homepage
     * @returns View
     * @params Podcast
     */
    public function home()
    {
        if (!Auth::check()) {
            return view('web.home');
        } else {
            if (! auth()->user()->isAdmin()) {
                return redirect(route('podcasts'));
            }
            return redirect(route('users'));
        }
    }

    /**
     * Lists all available shows
     */
    public function listPublishedPodcasts()
    {
        return view('web.shows');
    }

    /**
     * Help and Support
     * @returns View
     */
    public function help()
    {
        return view('web.help', [
            'articles' => Article::where('published', TRUE)->get(),
        ]);
    }

    /**
     * Displays an article to the visitor
     */
    public function viewArticle($article)
    {
        return view('web.article', [
            'article' => Article::where('slug', $article)->firstOrFail()
        ]);
    }

    /**
     * Donation Page
     * @returns View
     */
    public function donate()
    {
        return view('web.donate');
    }

    /**
     * Display the available patron plans
     */
    public function patronPlans()
    {
        return view('web.patron-plans');
    }
}
