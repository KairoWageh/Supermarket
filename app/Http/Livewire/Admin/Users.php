<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;

class Users extends Component
{
    public function render()
    {
    	$users = User::where('type', 1)->get();
    	$users_count =  $users->count();
        return view('livewire.admin.users', compact('users', 'users_count'));
    }
}
