<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        return view('admin.articles.index');
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'unique:articles,title'],
            'tags' => ['required'],
            'body' => ['required'],
            'lang' => ['required']
        ]);

        $store = Article::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'excerpt' => $request->excerpt,
                'tags' => $request->tags,
                'body' => $request->body,
                'user_id' => auth()->user()->id,
                'published' => false,
                'lang' => $request->lang,
            ]);

        if ($store) {
            session()->flash('message', 'Article successfully created.');
            return redirect(route('articles'));
        } else {
            Log::error("Article not saved. There was an error while attempting to store an article.");
            abort(403);
        }
    }

    public function edit(Article $article)
    {
        return view('admin.articles.edit', [
            'article' => $article,
        ]);
    }

    public function update(Article $article, Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'tags' => ['required'],
            'body' => ['required'],
            'lang' => ['required']
        ]);

        $update = $article->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'excerpt' => $request->excerpt,
            'tags' => $request->tags,
            'body' => $request->body,
            'user_id' => auth()->user()->id,
            'lang' => $request->lang,
        ]);

        if ($update) {
            session()->flash('message', 'Article successfully created.');
            return redirect(route('articles'));
        } else {
            Log::error("Article not saved. There was an error while attempting to update an article.");
            abort(403);
        }
    }
}
