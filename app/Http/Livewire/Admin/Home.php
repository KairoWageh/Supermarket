<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Admin;
use App\Models\Order;

class Home extends Component
{
    public function render()
    {
    	$user_count = User::where('type', 1)->count();

    	$admin_count = Admin::all()->count();
    	$market_count = User::where('type', 2)->count();
    	$order_count = Order::all()->count();
        return view('livewire.admin.home', compact('user_count', 'admin_count', 'market_count', 'order_count'));
    }
}
