<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DocumentationController extends Controller
{

    public function index()
    {
        $articles = scandir(resource_path('docs'));

        for ($i = 2; $i < count($articles); $i++) {
            $collection[] = [
                'article_title' => strip_tags(Str::markdown(file(resource_path('docs/'.$articles[$i]))[0])),
                'article_author' => strip_tags(Str::markdown(file(resource_path('docs/'.$articles[$i]))[1])),
                'article_date' => strip_tags(Str::markdown(file(resource_path('docs/'.$articles[$i]))[2])),
                'article_url' => substr($articles[$i], 0, -3)
            ];
        }

        return view('web.help', [
            'articles' => $collection
        ]);
    }

    public function show($article)
    {
        if (file_exists(resource_path('docs/'.$article.'.md'))) {
            $article = Str::markdown(file_get_contents(resource_path('docs/'.$article.'.md')));

            return view('web.article', [
                'article' => $article
            ]);
        } else {
            return redirect()->route('help');
        }

    }
}
