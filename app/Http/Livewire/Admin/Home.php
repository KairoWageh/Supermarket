<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Admin;

class Home extends Component
{
    public function render()
    {
    	$user_count = User::all()->count();
    	$admin_count = Admin::all()->count();
        return view('livewire.admin.home', compact('user_count', 'admin_count'));
    }
}
