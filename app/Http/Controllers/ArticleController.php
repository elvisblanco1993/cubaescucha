<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

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
        ]);

        $store = Article::create([
                'title' => $request->title,
                'tags' => $request->tags,
                'body' => $request->body,
                'user_id' => auth()->user()->id,
                'published' => false,
            ]);

        if ($store) {
            session()->flash('message', 'Article successfully created.');
            return redirect(route('articles'));
        }
    }
}
