<?php

namespace App\Http\Controllers\Api;
use App\Models\Like;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;


class AuthController extends Controller
{

    /*----------------------------Api aamalna Auth-----------------------------------*/



    /*======================= Register ============================*/

    public function register(Request $request,User $user)// Start Register
    {


        $rules=[
            'name'=>'required',
            'phone' => 'required|numeric|digits_between:1,20|unique:users',
            'phone_code'=>'required|numeric|digits_between:2,5',
            'email' => 'nullable|string|email|max:255|unique:users',
            'password' => 'required',

        ];

        $validate=Validator::make(request()->all(),$rules,['digits_between'=>'the phone number must be number no + in it']);

        if($validate->fails()) {

            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);
        }

          else{

            $user->name=$request->name;
            $user->email=$request->email;
            $user->phone=$request->phone;
            $user->phone_code=$request->phone_code;


            $user->password=bcrypt($request->password);




            // Check the software register


            $goodInsert=$user->save();



            if($goodInsert){



               $orders=Order::where('form_id',$user->id)->get();
                $like=Like::where('user_id',$user->id)->pluck('product_id')->toArray();
                                $productslike=Product::wherein('id',$like)->get();

                return response(['user'=>$user,'orders'=>$orders,'productslike'=>$productslike],200);
            }else{
                return response([
                    'status'=>false,
                    'message'=>'Insert fail',
                ],500);

            }//insert

        }//validation


    }// End Register

    /*=========================End Register============================*/


    /*======================= Login ============================*/


    public function login(Request $request)
    { // Start Login



            $rules = [
                'kayWord' => 'required',

                'password' => 'required',

            ];
            $validate = Validator::make(request()->all(), $rules);
            if ($validate->fails()) {

                return response(['message' => 'this is the all errors', 'errors' => $validate->messages()], 422);

            } else {

                if (Auth::attempt(['email' => request('kayWord'), 'password' => request('password')])) {
                    $user = Auth::user();

                    //  $user->api_token=str_random(60);



                    return response($user, 200);


                }
                if (Auth::attempt(['phone' => request('kayWord'), 'password' => request('password')])) {
                    $user = Auth::user();

                    //  $user->api_token=str_random(60);


                   $orders=Order::where('form_id',$user->id)->get();
                $like=Like::where('user_id',$user->id)->pluck('product_id')->toArray();
                                $productslike=Product::wherein('id',$like)->get();

                return response(['user'=>$user,'orders'=>$orders,'productslike'=>$productslike],200)

;
                }



                return response([
                    'messages' => 'Invalid phone or password',

                ], 404);
            }//no login


    }// validation


//login end

    /*=======================End Login ============================*/

    /*======================= Logout ============================*/

    public function logout(Request $request)
    {
        $rules=[

            'id'=>'required|numeric',


        ];

        $validate=Validator::make(request()->all(),$rules);

        if($validate->fails()){

            return response(['status'=>false,'message'=>'this is the all errors','errors'=>$validate->messages()],422);

        }else {
            $user = User::where('id', $request->id)->first();
           if($user) {
               return response()->json([
                   'message' => 'Successfully logged out'
               ],200);
           }
           return response()->json([
               'message' => 'user not found'
           ],404);
        }
    }

    /*=======================End Logout ============================*/
    public function canRest(Request $request)
    {
    // Start Login


        $rules = [
            'kayWord' => 'required',


        ];
        $validate = Validator::make(request()->all(), $rules);
        if ($validate->fails()) {

            return response(['message' => 'this is the all errors', 'errors' => $validate->messages()], 422);

        } else {
            $user=User::where('email',$request->kayWord)->orWhere('phone',$request->kayWord)->first();
            if($user){
                $is_found=1;
                return response(['can'=>$is_found,'user_id'=>$user->id],200);

            }else{
                $is_found=0;
                return response(['can'=>$is_found,'user_id'=>null],200);


            }
        }


        return response([
            'messages' => 'Invalid phone or password',

        ], 404);



    }// validation
    /*----------------------------End Api Emdad Auth-----------------------------------*/


}// Class
