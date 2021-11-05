<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Team;
use Livewire\Component;

class Index extends Component
{
    public $teams;
    public $query;

    public function mount()
    {
        $this->teams = Team::with('podcasts')->latest()->get();
    }

    public function cancel()
    {
        $this->query = '';
    }

    public function search()
    {
        $this->teams = Team::search($this->query)->take(10)->get();
    }

    public function render()
    {
        return view('livewire.admin.users.index');
    }
}
