<?php

namespace App\Http\Controllers\Api;
use App\Models\Admin;
use App\Models\Notification;
use App\Models\City;
use App\Models\Comment;
use App\Models\Category;
use App\Models\NotificationText;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductImages;
use App\Models\Room;
use App\Models\Image;
use App\Models\Ad;

use App\Models\User;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    public function my_notifications(Request $request)
    {
        $rules = [
            'user_id' => 'required',

        ];
        $validate = Validator::make(request()->all(), $rules, ['digits_between' => 'the phone number must be number no + in it']);

        if ($validate->fails()) {

            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);

        } else {
            $user = User::where('id', $request->user_id)->first();
            if ($user == null) {
                return response(['message' => 'user not found '], 422);
            }///// end user not found
            $notifications = Notification::where('user_id', $request->user_id)->orderBy('id','desc')->paginate(10);
            foreach ($notifications as $not) {
                $not->save();
            }
            return response($notifications, 200);
        }

    }
    public function my_notification(Request $request){
        if (!$request->user_id) {
            return response(['status' => false, 'message' => 'User id is required'], 422);
        }
        $user_id = User::where('id', $request->user_id)->first();
        if (!$user_id) {
            return response(['status' => false, 'message' => 'this user id not exists in DB  '], 422);
        }

        $notifications = Notification::where('to_id', $request->user_id)->get();
        foreach ($notifications as $notification) {
            $notification->is_read = 1;
            $notification->save();
        }
        //$notifications = Notification::where('to_id', $request->user_id)->get()->toArray();
        $notifications = Notification::where('to_id', $request->user_id)->paginate(15);
        if ($notifications != null) {
            $i = 0;
            foreach ($notifications as $notification) {
                $provider = User::where('id', $notification['from_id'])->first();
                $order = Order::where('id', $notification['order_id'])->first();

                $text = NotificationText::where('id', $notification->notification_id)->first();

                $notifications[$i]->ar_notification_title = $text->ar_title;
                $notifications[$i]->ar_notification_body = $text->ar_content;
                $notifications[$i]->en_notification_title = $text->en_title;
                $notifications[$i]->en_notification_body = $text->en_content;
                if ($order) {
                    $notifications[$i]->order_id = $order->id;
                } else {
                    $notifications[$i]->order_id=null;
                }
                if($provider) {
                    $notifications[$i]->provider = $provider->name;
                }else{
                    $notifications[$i]->provider ='لم يحدد بعد';
                }

                $i++;
            }
        }
        return response($notifications, 200);
    }//end


    public  function delete_my_notification (Request $request){
        $rules = [
            'user_id' => 'required',
            'notification_id' => 'required',

        ];
        $validate = Validator::make(request()->all(), $rules, ['digits_between' => 'the phone number must be number no + in it']);

        if ($validate->fails()) {

            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);

        } else {
            $user = User::where('id', $request->user_id)->first();
            $not = Notification::where('id', $request->notification_id)->first();
            if ($user == null) {
                return response(['message' => 'user not found '], 422);
            }///// end user not found
            if ($not == null) {
                return response(['message' => 'notification  not found '], 422);
            }///// end notification not found
             if ($not->to_id !=$user->id) {
                return response(['message' => 'not allow  for delete '], 422);
            }///// end allow
            $not->delete();
            return response(['message' => 'notification deleted '], 200);
        }
    }

    public function search(Request $request)
    {
        $rules = [
            'key_word' => 'required',



        ];
        $validate = Validator::make(request()->all(), $rules);

        if ($validate->fails()) {

            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);

        } else {
      /*  $categories= Category::all();
        $subcategories = Subcategory::all();*/

        $keyword = $request['key_word'];
        $ads = Product::where('name', 'like', '%' . $keyword . '%')->orWhere('price', 'like', '%' . $keyword . '%')->orderBy('id','desc')->get();

        $user = User::where('name', 'like', '%' . $keyword . '%')->orWhere('shop_name', 'like', '%' . $keyword . '%')->first();
        if ($user) {
            $ads = Product::where('form_id', $user->id)->orderBy('id','desc')->get();
            $i = 0;
            foreach ($ads as $ad) {
                $image = ProductImages::where('ad_id', $ad->id)->first();
                $cat = Category::where('id', $ad->category_id)->first();
                $scat = SubCategory::where('id', $ad->sub_category_id)->first();
                if($image) {
                    $ads[$i]['image'] = $image->image;
                }else{ $ads[$i]['image'] = null;}

                $ads[$i]['category_name'] = $cat->name;
                $ads[$i]['sub_category_name'] = $scat->name;
                $i++;
            }
            return response(['data'=>$ads], 200);
        }
        $cat = Category::where('name', 'like', '%' . $keyword . '%')->first();
        if ($cat) {
            $ads = Product::where('category_id', $cat->id)->get();
            $i = 0;
            foreach ($ads as $ad) {
                $image = ProductImages::where('product_id', $ad->id)->first();
                $cat = Category::where('id', $ad->category_id)->first();
                $scat = SubCategory::where('id', $ad->sub_category_id)->first();
                if ($image) {
                    $ads[$i]['image'] = $image->image;
                } else {
                    $ads[$i]['image'] = null;

                }
                $ads[$i]['category_name'] = $cat->name;
                $ads[$i]['sub_category_name'] = $scat->name;
                $i++;
            }
            return response(['data'=>$ads], 200);
        }
        $subcat = Subcategory::where('name', 'like', '%' . $keyword . '%')->first();
        if ($subcat) {
            $ads = Product::where('subcategory_id', $subcat->id)->orderBy('id','desc')->get();
            $i = 0;
            foreach ($ads as $ad) {
                $image = ProductImages::where('product_id', $ad->id)->first();
                $cat = Category::where('id', $ad->category_id)->first();
                $scat = Subcategory::where('id', $ad->sub_category_id)->first();
                if($image) {
                    $ads[$i]['image'] = $image->image;
                }else{ $ads[$i]['image'] = null;}
                $ads[$i]['category_name'] = $cat->name;
                $ads[$i]['sub_category_name'] = $scat->name;
                $i++;
            }
            return response(['data'=>$ads], 200);
        }
            $i = 0;
            foreach ($ads as $ad) {
                $image = ProductImages::where('product_id', $ad->id)->first();
                $cat = Category::where('id', $ad->category_id)->first();
                $scat = Subcategory::where('id', $ad->sub_category_id)->first();
                if ($image) {
                    $ads[$i]['image'] = $image->image;
                } else {
                    $ads[$i]['image'] = null;
                }
                $ads[$i]['category_name'] = $cat->name;
                $ads[$i]['sub_category_name'] = $scat->name;
                $i++;
            }
            return response(['data'=>$ads], 200);
    }
}
}



