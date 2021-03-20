<?php

namespace App\Http\Controllers\Api;




use App\Models\Admin;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderDetailes;
use App\Models\Product;
use App\Models\ProductImages;
use App\Models\User;
use Carbon\Carbon;
use DB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator;


class OrderController extends Controller
{

public function my_orders(Request $request)
 {
     $rules = [
         'user_id' => 'required',
         'type' => 'required|in:0,2,3,1',


     ];
     $validate = Validator::make(request()->all(), $rules);

     if ($validate->fails()) {

         return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);

     } else {


         $user = User::where('id', $request->user_id)->first();
         if (!$user) {
             return response(['message' => 'user not found '], 422);
         }
         if($user->type==1){
             $orders=Order::where('form_id',$request->user_id)->where('status',$request->type)->get();
             $i=0;
             foreach ($orders as $order){
                 $receiver=User::where('id',$order->to_id)->first();


                 $orders[$i]['seller_ar_title']=$receiver->ar_title;
                                  $orders[$i]['seller_en_title']=$receiver->en_title;

                 $orders[$i]['seller_phone']=$receiver->phone;
                 $orders[$i]['seller_image']=$receiver->image;
                 $orders[$i]['seller_id']=$receiver->id;
                 $i++;
             }
             return response(['data' => $orders], 200);
         }
         if($user->type==2){
             $orders=Order::where('to_id',$request->user_id)->where('status',$request->type)->get();
             $i=0;
             foreach ($orders as $order){
                 $receiver=User::where('id',$order->form_id)->first();


                 $orders[$i]['user_name']=$receiver->name;
                 $orders[$i]['user_phone']=$receiver->phone;
                 $orders[$i]['user_image']=$receiver->image;
                 $orders[$i]['user_id']=$receiver->id;
                 $i++;
             }
             return response(['data' => $orders], 200);
         }
     }
 }
 public function single_order(Request $request)
 {
     $rules = [
         'order_id' => 'required',


     ];
     $validate = Validator::make(request()->all(), $rules);

     if ($validate->fails()) {

         return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);

     } else {


         $order = Order::where('id', $request->order_id)->first();
         if (!$order) {
             return response(['message' => 'order not found '], 422);
         }

             $orders=OrderDetailes::where('order_id',$request->order_id)->get();
             $i=0;
             foreach ($orders as $ord){
                 $product=Product::where('id',$ord->product_id)->first();
                 $image=ProductImages::where('product_id',$product->id)->first();


                 $orders[$i]['product_name']=$product->name;
                 $orders[$i]['product_price']=$product->price;
                 if ($image) {
                     $orders[$i]['product_image'] = $image->image;
                 }else{  $orders[$i]['product_image'] = null;}
                 $orders[$i]['product_id']=$product->id;
                 $i++;
             }
             return response(['order'=>$order,'data' => $orders], 200);
         }

 }
 public function add_order(Request $request){
     $rules = [

         'form_id' => 'required',
         'to_id' => 'required',

         'orderDetalis' => 'required',


     ];
     $validate = Validator::make(request()->all(), $rules);

     if ($validate->fails()) {

         return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);
     }
     $products=Product::pluck('id')->toArray();
     if(in_array($request->product_id,$products)){
         return response(['message'=>'product not found'],422);
     }
     $form=User::where('id',$request->form_id)->first();
     if(!$form){
         return response(['message'=>'user not found'],422);

     }  $to=User::where('id',$request->to_id)->first();
     if(!$to){
         return response(['message'=>'user not found'],422);

     }
     $order=new Order();
     $order->form_id=$request->form_id;
     $order->to_id=$request->to_id;

     $order->save();
     if($request->orderDetalis){
         $detalis=$request->orderDetalis;
         foreach ($detalis as $d){
             $order=Order::orderBy('id','desc')->first();
             $product=Product::where('id',$d['product_id'])->first();
             $p=new OrderDetailes();
             $p->order_id=$order->id;
             $p->product_id=$product->id;
             $p->amount=$d['amount'];
             $p->total=$d['amount']*$product->price;
             $p->save();


         }
         $amounts=OrderDetailes::where('order_id',$order->id)->sum('amount');
         $totals=OrderDetailes::where('order_id',$order->id)->sum('total');
         $order->amount+=$amounts;
         $order->total+=$totals;
         $order->save();
         $not=new Notification();
         $not->from_id=$order->form_id;
         $not->to_id=$order->to_id;
         $not->notification_date=strtotime(now());
         $not->type=1;
         $not->notification_id=1;
         $not->save();
         $admins=Admin::all();
         foreach ($admins as $admin){
             $not=new Notification();
             $not->from_id=$order->form_id;
             $not->to_id=$admin->id;
             $not->notification_date=strtotime(now());
             $not->type=1;
             $not->notification_id=1;
             $not->save();
         }
         return response($order,200);
     }


 }
 public function accept_order(Request $request)
 {
     $rules = [
         'order_id' => 'required',
         'user_id' => 'required',


     ];
     $validate = Validator::make(request()->all(), $rules);

     if ($validate->fails()) {

         return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);

     } else {


         $order = Order::where('id', $request->order_id)->first();
         if (!$order) {
             return response(['message' => 'order not found '], 422);
         }
         $user = User::where('id', $request->user_id)->first();
         if (!$user) {
             return response(['message' => 'user not found '], 422);
         }
         $oner = User::where('id', $order->to_id)->first();
         if ($user != $oner) {
             return response(['message' => 'you not have this order '], 422);

         }
         if($order->status==2){
             return response(['message' => 'you already accpeted  '], 422);

         }
         $order->status=2;
          $order->save();
         $not=new Notification();
         $not->form_id=$order->to_id;
         $not->to_id=$order->form_id;
         $not->notification_date=strtotime(now());
         $not->type=1;
         $not->notification_name=2;
         $not->save();
         $admins=Admin::all();
         foreach ($admins as $admin){
             $not=new Notification();
             $not->form_id=$order->form_id;
             $not->to_id=$admin->id;
             $not->notification_date=strtotime(now());
             $not->type=1;
             $not->notification_name=3;
             $not->save();
         }
         return response($order,200);

     }
 }
 public function canceling_order(Request $request)
 {
     $rules = [
         'order_id' => 'required',
         'user_id' => 'required',


     ];
     $validate = Validator::make(request()->all(), $rules);

     if ($validate->fails()) {

         return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);

     } else {


         $order = Order::where('id', $request->order_id)->first();
         if (!$order) {
             return response(['message' => 'order not found '], 422);
         }
         $user = User::where('id', $request->user_id)->first();
         if (!$user) {
             return response(['message' => 'user not found '], 422);
         }
         $oner = User::where('id', $order->to_id)->first();
         $form_id = User::where('id', $order->form_id)->first();
         if (($user != $oner)&&($user != $form_id)) {
             return response(['message' => 'you not have this order '], 422);

         }
         if($order->status==3){
             return response(['message' => 'you already caneled  '], 422);

         }
         $order->status=3;
          $order->save();
         $not=new Notification();
         if($user==$oner) {
             $not->form_id = $order->to_id;
             $not->to_id = $order->form_id;
         }else{
             $not->to_id = $order->to_id;
             $not->form_id = $order->form_id;
         }
         $not->notification_date=strtotime(now());
         $not->type=1;
         $not->notification_name=3;
         $not->save();
         $admins=Admin::all();
         foreach ($admins as $admin){
             $not=new Notification();
             $not->form_id=$order->form_id;
             $not->to_id=$admin->id;
             $not->notification_date=strtotime(now());
             $not->type=1;
             $not->notification_name=3;
             $not->save();
         }
         return response($order,200);

     }
 }
 public function finshing_order(Request $request)
 {
     $rules = [
         'order_id' => 'required',
         'user_id' => 'required',


     ];
     $validate = Validator::make(request()->all(), $rules);

     if ($validate->fails()) {

         return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);

     } else {


         $order = Order::where('id', $request->order_id)->first();
         if (!$order) {
             return response(['message' => 'order not found '], 422);
         }
         $user = User::where('id', $request->user_id)->first();
         if (!$user) {
             return response(['message' => 'user not found '], 422);
         }
         $oner = User::where('id', $order->to_id)->first();
         $form_id = User::where('id', $order->form_id)->first();
         if (($user != $oner)&&($user != $form_id)) {
             return response(['message' => 'you not have this order '], 422);

         }
         if($order->status==4){
             return response(['message' => 'you already fhening  '], 422);

         }
         $order->status=4;
          $order->save();
         $not=new Notification();
         if($user==$oner) {
             $not->form_id = $order->to_id;
             $not->to_id = $order->form_id;
         }else{
             $not->to_id = $order->to_id;
             $not->form_id = $order->form_id;
         }
         $not->notification_date=strtotime(now());
         $not->type=1;
         $not->notification_name=4;
         $not->save();
         $admins=Admin::all();
         foreach ($admins as $admin){
             $not=new Notification();
             $not->form_id=$order->form_id;
             $not->to_id=$admin->id;
             $not->notification_date=strtotime(now());
             $not->type=1;
             $not->notification_name=4;
             $not->save();
         }
         return response($order,200);

     }
 }
    public function createNew(Request $request)
    {
        //Validation
        $validator = Validator::make($request->all(), [
            'name'           => 'required|string',
            'mobile_number'  => 'required|regex:/^[0][0-9]{10}/',
            'email'          => 'nullable|email',
            'notes'          => 'nullable|string',
            'address'        => 'required|string',
            'latitude'       => 'required|numeric',
            'longitude'      => 'required|numeric',
            'city_id'        => 'required|numeric',
            'items_selected' => 'required',//[[product_id,amount],[product_id,amount], ...]
        ]);

        if ($validator->fails())
        {
            return response()->json([
                'message' => 'Validation Error, check error for details.',
                'error'   => $validator->errors()
            ], 422);
        }

        //init total price
        $total_price = 0;

        //get the products selected
        $items_selected = $request['items_selected']; //[[product_id,amount],[product_id,amount], ...]

        foreach ($items_selected as $item)
        {
            $product = Product::find($item['product_id']);
            if (!$product){
                return response('Product id not exists',422);
            }
            $total_price += $product['price'] * $item['quantity'];
        }

        //Create new Order
        $order = Order::create([
            'name'          => $request['name'],
            'mobile_number' => $request['mobile_number'],
            'email'         => $request['email'],
            'notes'         => $request['notes'],
            'address'       => $request['address'],
            'latitude'      => $request['latitude'],
            'longitude'     => $request['longitude'],
            'total_price'   => $total_price,
            'city_id'       => $request['city_id'],
            'status'        => 0,
            'is_seen'       => 0,
        ]);


        if ($order)
        {
            foreach ($items_selected as $item)
            {
                //dd($item);
                $product = Product::find($item['product_id']);
                $order->products()->attach($product['id'], ['quantity' => $item['quantity']]);
            }

            return response()->json([
                'message' => 'Order Created Successfully.'
            ], 200);
        } else
        {
            return response()->json([
                'Error' => 'Could not create the order.',
            ], 422);
        }
    }
}
