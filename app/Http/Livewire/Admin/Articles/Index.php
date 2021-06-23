<?php

namespace App\Http\Livewire\Admin\Articles;

use App\Models\Article;
use Livewire\Component;

class Index extends Component
{
    public $articles;
    public $query;

    public function mount()
    {
        $this->articles = Article::get();
    }

    public function cancel()
    {
        $this->query = '';
    }

    public function search()
    {
        $this->articles = Article::search($this->query)->take(10)->get();
    }

    public function render()
    {
        return view('livewire.admin.articles.index');
    }
}
