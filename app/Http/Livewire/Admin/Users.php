<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;

class Users extends Component
{
    public function render()
    {
    	$users = User::where('type', 1)->get();
        return view('livewire.admin.users', compact('users'));
    }
}
