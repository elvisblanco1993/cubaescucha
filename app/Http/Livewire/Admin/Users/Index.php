<?php

namespace App\Http\Livewire\Admin\Users;

use Livewire\Component;
use \App\Models\User;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $users;

    public function impersonate($userId)
    {
        if(! auth()->user()->isAdmin()) {
            return;
        }

        $user = User::findOrFail($userId);

        $originalId = auth()->user()->id;
        session()->put('impersonate', $originalId);
        Auth::onceUsingId($userId);
        return redirect('/podcasts');
    }

    public function render()
    {
        $this->users = User::where('role', 'User')->get();

        return view('livewire.admin.users.index', [
            'users' => $this->users,
        ]);
    }
}
