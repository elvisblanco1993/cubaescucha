<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Team;
use App\Models\Podcast;
use Carbon\Carbon;

class Graphs extends Component
{
    public $teams_total;
    public $teams_new;
    public $podcasts_total;
    public $filterRange;

    public function mount()
    {
        $this->teams_total = Team::count();
        $this->teams_new = Team::where('created_at', '>=', Carbon::today()->subDays(30))->count();
        $this->podcasts_total = Podcast::count();
    }

    public function filterNewTeams()
    {
        $this->teams_new = Team::where('created_at', '>=', Carbon::today()->subDays($this->filterRange))->count();
    }

    public function render()
    {
        return view('livewire.admin.graphs');
    }
}
