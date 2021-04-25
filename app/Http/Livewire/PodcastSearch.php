<?php

namespace App\Http\Livewire;

use App\Models\Podcast;
use Livewire\Component;

class PodcastSearch extends Component
{
    public $query;
    public $podcasts;

    public function mount()
    {
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->query = '';
        $this->podcasts = [];
    }

    public function updatedQuery()
    {
        $this->podcasts = Podcast::search($this->query)->take(10)->get();
    }

    public function render()
    {
        return view('livewire.podcast-search');
    }
}
