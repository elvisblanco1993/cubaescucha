<?php

namespace App\Http\Livewire\Admin\Users;

use \App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public $users;
    public $query;

    public function mount()
    {
        $this->users = User::with('podcasts')->latest()->get();
    }

    public function cancel()
    {
        $this->query = '';
    }

    public function search()
    {
        $this->users = User::search($this->query)->take(10)->get();
    }

    public function render()
    {
        return view('livewire.admin.users.index');
    }
}
