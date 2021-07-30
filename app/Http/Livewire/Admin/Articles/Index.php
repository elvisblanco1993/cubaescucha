<?php

namespace App\Http\Livewire\Admin\Articles;

use App\Models\Article;
use Carbon\Carbon;
use Livewire\Component;

class Index extends Component
{
    public $articles;
    public $query;
    public $deleteDialog;

    public function mount()
    {
        $this->articles = Article::with('user')->latest()->get();
    }

    public function cancel()
    {
        $this->query = '';
    }

    public function search()
    {
        $this->articles = Article::search($this->query)->take(10)->get();
    }

    public function edit($article)
    {
        return redirect(route('article-edit', ['article'=> $article]));
    }

    // Change the status between published and draft
    public function changeStatus(Article $article)
    {
        if ($article->published == FALSE) {
            $article->published = TRUE;
            $article->published_at = Carbon::now();
            $article->save();
        } else {
            $article->published = FALSE;
            $article->published_at = null;
            $article->save();
        }

        // Refresh the data
        $this->articles = $this->articles->fresh();
    }

    // Delete article
    public function delete($article)
    {
        dd(
            $article
        );
    }

    public function render()
    {
        return view('livewire.admin.articles.index');
    }
}
