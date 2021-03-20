<?php

namespace App\Http\Controllers\Api;




use App\Models\Follow;
use App\Models\Like;
use App\Models\Order;
use App\Models\Product;
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


class ProfileController extends Controller
{
public  function update_profile(Request $request)
{
    $rules = [
        'user_id' => 'required',
        'name' => 'nullable|string',
        'paasword' => 'nullable|string',

        'email' => 'nullable|string|email',

        'phone_code' => 'nullable|numeric|digits_between:2,20',
        'phone' => 'nullable|numeric|digits_between:8,20',


    ];
    $validate = Validator::make(request()->all(), $rules);

    if ($validate->fails()) {

        return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);

    } else {


        $user = User::where('id', $request->user_id)->first();
        if (!$user) {
            return response(['message' => 'user not found '], 422);
        }
        $user_phone = User::where('id', '!=', $user->id)->where('phone', $request->phone)->get();


        if ($user_phone->count() != 0) {
            return response(['status' => false, 'message' => 'The phone is already taken'], 422);

        }  $user_shop_name = User::where('id', '!=', $user->id)->where('phone', $request->shop_name)->get();


        if ($user_shop_name->count() != 0) {
            return response(['status' => false, 'message' => 'The _shop_name is already taken'], 422);

        }
        if ($request->name) {
            $user->name = $request->name;
        }
        if ($request->email) {
            $user->email = $request->email;
        } if ($request->password) {
 $user->password=bcrypt($request->password);        }
        $user->phone_code = $request->phone_code;
        if( $request->phone){
            $user->phone = $request->phone;
        }
        if ($request->latitude) {
            $user->latitude = $request->latitude;
        }
        if ($request->longitude) {
            $user->longitude = $request->longitude;
        }
        $user->save();
       $orders=Order::where('form_id',$user->id)->get();
                $like=Like::where('user_id',$user->id)->pluck('product_id')->toArray();
                                $productslike=Product::wherein('id',$like)->get();

                return response(['user'=>$user,'orders'=>$orders,'productslike'=>$productslike],200);
    }
}
    public function user_image(Request $request)
    {
        $rules = [
            'user_id' => 'required',
            'image' => 'required|image|mimes:jpeg,jpg,png,gif',
        ];

        $validate = Validator::make(request()->all(), $rules);


        if ($validate->fails()) {

            return response(['message' => 'this is the all errors', 'errors' => $validate->messages()], 422);

        } else {
            $user = User::where('id', $request->user_id)->first();
            if (!$user) {
                return response()->json(['user_not_found'], 404);
            }  //check user

            if (!$request->hasFile('image')) {
                return response()->json(['upload_file_not_found'], 404);
            }//ckeck   avatar

            if ($user->image) {

                $imageName = url("uploads/{$user->image}"); // get previous image from folder
                if (File::exists($imageName)) { // unlink or remove previous image from folder
                    unlink($imageName);
                }
            }
                $image = $request->file('image');
                $imageName = time() . '.' .\request('image')->getClientOriginalExtension();

                $user->image = 'users/'.$imageName;
                $image->move('uploads/users', $imageName);
            }
            $user->save();

            $save = $user->save();
            if ($save) {


                $orders=Order::where('form_id',$user->id)->get();
                $like=Like::where('user_id',$user->id)->pluck('product_id')->toArray();
                                $productslike=Product::wherein('id',$like)->get();

                return response(['user'=>$user,'orders'=>$orders,'productslike'=>$productslike],200);


            } else {
                return response(['message' => 'Error in update'], 404);

            }// Save


    }// validate
 public function user_banner(Request $request)
    {
        $rules = [
            'user_id' => 'required',
            'bannar_image' => 'required|image|mimes:jpeg,jpg,png,gif',
        ];

        $validate = Validator::make(request()->all(), $rules);


        if ($validate->fails()) {

            return response(['message' => 'this is the all errors', 'errors' => $validate->messages()], 422);

        } else {
            $user = User::where('id', $request->user_id)->first();
            if (!$user) {
                return response()->json(['user_not_found'], 404);
            }  //check user

            if (!$request->hasFile('bannar_image')) {
                return response()->json(['upload_file_not_found'], 404);
            }//ckeck   avatar


            if ($user->bannar_image) {

                $imageName = url("uploads/{$user->bannar_image}"); // get previous image from folder
                if (File::exists($imageName)) { // unlink or remove previous image from folder
                    unlink($imageName);
                }
            }
                $image = $request->file('bannar_image');
                $imageName = time() . '.' .\request('bannar_image')->getClientOriginalExtension();

                $user->bannar_image = 'users/'.$imageName;
                $image->move('uploads/users', $imageName);
            }

            $user->save();

            $save = $user->save();
            if ($save) {


                $orders=Order::where('form_id',$user->id)->get();
                $products=Product::where('form_id',$user->id)->get();
                $follows=Follow::where('form_id',$user->id)->get();
                $like=Like::where('form_id',$user->id)->get();
                return response(['user'=>$user,'orders'=>$orders,'products'=>$products,'follows'=>$follows,'like'=>$like],200);



            } else {
                return response(['message' => 'Error in update'], 404);

            }// Save


        }

}
