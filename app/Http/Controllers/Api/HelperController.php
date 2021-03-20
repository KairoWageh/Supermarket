<?php

namespace App\Http\Controllers\Api;



use App\Models\Like;
use App\Models\Category;


use App\Models\ContactUs;

use App\Models\Payment;
use App\Models\Wallet;

use App\Models\Product;
use App\Models\ProductImage;

use App\Models\SiteText;

use App\Models\Slider;
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

class HelperController extends Controller
{
    /*=========================== contact_us ============================*/

    public function contact_us(Request $request)
    {

        $rules = [
            'name' => 'nullable|string',
            'email' => 'required|string|email|max:255',
            'title' => 'nullable|string|max:190',
            'message' => 'required|string|max:2000',
        ];
        $validate = Validator::make(request()->all(), $rules);

        if ($validate->fails()) {

            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);

        } else {

            $contact = new ContactUs();
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->title = $request->title;
            $contact->message = $request->input('message');


            $save = $contact->save();

            if ($save) {

                // Send To admin


                return response($contact, 200);

            } else {
                return response([
                    'status' => false,
                    'message' => 'Insert fail',
                ], 404);

            }//insert


        }//validate


    }//end fun
    ////add balance

    /*=========================== get alll info for user  ============================*/


    public function delete_follower(Request $request)
    {

        $rules = [
            'user_id' => 'required',
            'follower_id' => 'required',

        ];
        $validate = Validator::make(request()->all(), $rules);

        if ($validate->fails()) {

            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);

        } else {
            $follower = Follow::where(['followed_id' => $request->user_id, 'follower_id' => $request->follower_id])->first();
            if ($follower) {
                Follow::where(['followed_id' => $request->user_id])->delete();
                return response(['message' => 'follower deleted'], 200);
            }
            return response(['message' => 'follower not found or some thing '], 422);

        }//validate


    }//end fun

    public function payment(Request $request)
    {
        $rules = [
            'user_id' => 'required',
                        'image' => 'required|image|mimes:jpeg,jpg,png,gif',
                        'amount'=>'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',


        ];
        $validate = Validator::make(request()->all(), $rules);

        if ($validate->fails()) {

            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);

        } else {
            $user = User::where('id', $request->user_id)->first();
            if (!$user) {
                return response(['message' => 'user not found'], 422);
            }
              $payment=new Payment();
              $payment->user_id=$request->payment;
              $image = $request->file('image');
                $imageName = time() . '.' .\request('image')->getClientOriginalExtension();

                $payment->image = 'payments/'.$imageName;
                $image->move('uploads/payments', $imageName);
                $payment->amount=$request->amount;
                $payment->save();
            return response($payment, 200);
        }
    }
    /*=========================== get banks accounts for site  ============================*/
     public function my_wallet(Request $request)
    {
        $rules = [
            'user_id' => 'required',
                       


        ];
        $validate = Validator::make(request()->all(), $rules);

        if ($validate->fails()) {

            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);

        } else {
            $user = User::where('id', $request->user_id)->first();
            if (!$user) {
                return response(['message' => 'user not found'], 422);
            }
              $payment=Wallet::where('user_id',$request->user_id)->first();
              if(!$payment){
                $payment=new Wallet();
                $payment->user_id=$request->user_id;
                $payment->save();
              }
             
            return response($payment, 200);
        }
    }
    /*=========================== get banks accounts for site get_shops  ============================*/
    public function banks()
    {
        $banks = Bank::all();
        return response(['data' => $banks], 200);
    }
     public function get_shops()
    {
        $shops = User::where('type',2)->get();
        return response(['data' => $shops], 200);
    }
      public function sliders()
    {
        $sliders = Slider::all();
        return response(['data' => $sliders], 200);
    }
    /*==============aboutUs==========*/
    public function aboutUs(){
        $keyword="ab";
        $aboutUs=SiteText::where('en_title', 'like', '%' . $keyword . '%')->first();
        return response(['data'=>$aboutUs],200);
    }
    /*==============condtions==========*/
 public function condtions(){
        $keyword="co";
        $co=SiteText::where('en_title', 'like', '%' . $keyword . '%')->first();


            return response(['data'=>$co],200);


    }
    public function rate(Request $request){
        $rules = [
            'form_id' => 'required',
            'to_id' => 'required',
            'rate' => 'required|numeric|in:1,2,3,4,5',
            'comment' => 'nullable',

        ];
        $validate = Validator::make(request()->all(), $rules, ['digits_between' => 'the phone number must be number no + in it']);

        if ($validate->fails()) {

            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);

        } else {


            $user = User::where('id', $request->form_id)->first();
            if (!$user) {
                return response(['message' => 'user not found '], 422);
            }
            $provider = Product::where('id', $request->to_id)->first();
            if (!$provider) {
                return response(['message' => 'provider not found '], 422);
            }
            $rate=new Rate();
            $rate->form_id=$request->form_id;
            $rate->to_id=$request->to_id;
            $rate->rate=$request->rate;
            $rate->comment=$request->comment;
            $rate->save();
            return response($rate,200);


    }
 }
    public function liketoggle(Request $request){
        $rules = [
            'user_id' => 'required',
            'product_id' => 'required',


        ];
        $validate = Validator::make(request()->all(), $rules);

        if ($validate->fails()) {

            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);

        } else {


            $user = User::where('id', $request->user_id)->first();
            if (!$user) {
                return response(['message' => 'user not found '], 422);
            }
            $provider = Product::where('id', $request->product_id)->first();
            if (!$provider) {
                return response(['message' => 'product not found '], 422);
            }
$l=Like::where(['user_id'=>$request->user_id,'product_id'=>$request->product_id])->first();
            if (!$l) {
                $like = new Like();
                $like->user_id = $request->user_id;
                $like->product_id = $request->product_id;
                $like->save();
                return response($like,200);
            } else {
                $l->delete();
                return response(['message'=>'you like deleted'],422);
            }



    }
 }
    public function follow(Request $request){
        $rules = [
            'form_id' => 'required',
            'to_id' => 'required',


        ];
        $validate = Validator::make(request()->all(), $rules);

        if ($validate->fails()) {

            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);

        } else {


            $user = User::where('id', $request->form_id)->first();
            if (!$user) {
                return response(['message' => 'user not found '], 422);
            }
            $provider = User::where('id', $request->to_id)->first();
            if (!$provider) {
                return response(['message' => 'provider not found '], 422);
            }
$l=Follow::where(['form_id'=>$request->form_id,'to_id'=>$request->to_id])->first();
            if (!$l) {
                $follow = new Follow();
                $follow->form_id = $request->form_id;
                $follow->to_id = $request->to_id;
                $follow->save();
                return response($follow,200);
            } else {
             $l->delete();
             return response(['message'=>'delete follow']);
            }



    }
 }
    public function single_product (Request $request){
          $rules = [
            'product_id' => 'required',
                      

        ];
        $validate = Validator::make(request()->all(), $rules);

        if ($validate->fails()) {

            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);

        } else {
            $product = Product::where('id', $request->product_id)->first();
            if (!$product) {
                return response(['message' => 'product not found'], 422);
            }
     $docs=ProductImage::Where('product_id',$request->product_id)->get();
    
     return response(['product'=>$product,'images'=>$docs],200);
    }}
     public function sub_categories (Request $request){
          $rules = [
            'category_id' => 'required',
                      

        ];
        $validate = Validator::make(request()->all(), $rules);

        if ($validate->fails()) {

            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);

        } else {
            $user = Category::where('id', $request->category_id)->first();
            if (!$user) {
                return response(['message' => 'category not found'], 422);
            }
     $docs=Category::Where('parent_id',$request->category_id)->get();
     $r=0;
     foreach ($docs as $d) {
        $products=Product::where('category_id',$d->id)->get();
        $docs[$r]['products']=$products;
        $r++;
     }
     return response($docs,200);
    }}
      public function all_categories (Request $request){
          $rules = [
            'user_id' => 'required',
                      

        ];
        $validate = Validator::make(request()->all(), $rules);

        if ($validate->fails()) {

            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);

        } else {
            $user = User::where('id', $request->user_id)->first();
            if (!$user) {
                return response(['message' => 'user not found'], 422);
            }
     $docs=Category::where('user_id',0)->orWhere('user_id',$request->user_id)->get();
     return response($docs,200);
    }}
    public function brands (){
     $docs=Brand::all();
     return response(['data'=>$docs],200);
    }
 public function shopes_search (Request $request){
          $rules = [
            'keyword' => 'required',
                      

        ];
        $validate = Validator::make(request()->all(), $rules);

        if ($validate->fails()) {

            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);

        } else {
            $kayword =$request->keyword;
            
     $docs=user::where('type',2)->Where('ar_title','like','%' . $kayword . '%')->orWhere('en_title','like','%' . $kayword . '%')->get();
     return response($docs,200);
    }}
     public function categories_search (Request $request){
          $rules = [
            'keyword' => 'required',
                      

        ];
        $validate = Validator::make(request()->all(), $rules);

        if ($validate->fails()) {

            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);

        } else {
            $kayword =$request->keyword;
            
     $docs=Category::where('level','!=',0)->Where('ar_title','like','%' . $kayword . '%')->orWhere('en_title','like','%' . $kayword . '%')->get();
       $r=0;
     foreach ($docs as $d) {
        $products=Product::where('category_id',$d->id)->get();
        $docs[$r]['products']=$products;
        $r++;
     }
     return response($docs,200);
    }}
     public function product_search (Request $request){
          $rules = [
            'keyword' => 'required',
                      

        ];
        $validate = Validator::make(request()->all(), $rules);

        if ($validate->fails()) {

            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);

        } else {
            $kayword =$request->keyword;
            
     $docs=Product::Where('ar_title','like','%' . $kayword . '%')->orWhere('en_title','like','%' . $kayword . '%')->get();
    
     return response($docs,200);
    }}
}
