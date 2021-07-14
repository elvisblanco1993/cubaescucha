<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Podcast;
use Carbon\Carbon;

class Graphs extends Component
{
    public $users_total;
    public $users_new;
    public $podcasts_total;
    public $filterRange;

    public function mount()
    {
        $this->users_total = User::count();
        $this->users_new = User::where('created_at', '>=', Carbon::today()->subDays(30))->count();
        $this->podcasts_total = Podcast::count();
    }

    public function filterNewUsers()
    {
        $this->users_new = User::where('created_at', '>=', Carbon::today()->subDays($this->filterRange))->count();
    }

    public function render()
    {
        return view('livewire.admin.graphs');
    }
}
