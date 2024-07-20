<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Livewire\Component;

class ProfileNav extends Component
{
    public function render()
    {
        $user = auth()->user();
        // dd(request('username'));
        $username = request('username') ? request('username') : $user->username;
        return view('livewire.profile.profile-nav', compact('user','username'));
    }
}
