<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use App\Models\Podcast;

class WebController extends Controller
{
    /**
     * Homepage
     * @returns View
     * @params Podcast
     */
    public function home()
    {
        $podcastsList = Podcast::orderBy('created_at', 'DESC')->simplePaginate(8);

        if (!Auth::check()) {
            return view('web.home', [
                'podcastsList' => $podcastsList,
            ]);
        } else {
            if (! auth()->user()->isAdmin()) {
                return redirect(route('podcasts'));
            }
            return redirect(route('users'));
        }
    }

    /**
     * Help and Support
     * @returns View
     */
    public function help()
    {
        return view('web.help', [
            'articles' => Article::with('user')->where('published', TRUE)->paginate(10)
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
