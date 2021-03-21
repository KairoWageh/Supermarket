<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Repository\sql\OrderRepository;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use DB;

class Orders extends Component
{
    public $selected_user, $user_name, $user_email, $user_phone, $user_nationality, $user_gender, $events;
    public function render()
    {
    	// get all orders
    	$orderRepository = resolve(OrderRepository::class);
        $model = resolve(Order::class);
        $orders = $orderRepository->all($model);
        $order_detailes = DB::table('order_detailes')->get();

        foreach ($orders as $order) {
	        foreach($order_detailes as $details){
	        	if($order->id == $details->order_id){
	        		$product_id = $details->product_id;
	        		$product = Product::find($product_id);
	        		$order->product = $product;
	        		$order->amount = $details->amount;

	        	}
	        	$form_id = $order->from_id;
	        	$to_id   = $order->to_id;

	        	$buyer  = User::find($form_id);
	        	$seller = User::find($to_id);
	        	$order->buyer = $buyer;
	        	$order->seller = $seller;
	        }
        }
        return view('livewire.admin.orders', compact('orders'));
    }
    public function showOrder($id){
    	$orderRepository = resolve(OrderRepository::class);
        $model = resolve(Order::class);
    	$this->selected_order = $orderRepository->find($model, $id);
    }
}
