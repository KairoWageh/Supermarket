<?php

namespace App\Http\Controllers\Api;



use App\Admin;
use App\Brand;
use App\Category;
use App\Company;

use App\Contact;
use App\Document;
use App\Follow;
use App\Like;
use App\Product;
use App\ProductImages;
use App\Qualification;
use App\HandGraduation;
use App\EmailType;
use App\Bank;

use App\Rate;
use App\ServicePrice;
use App\Setting;
use App\SiteText;
use App\Skill;
use App\Slider;
use App\SubCategory;
use App\User;
use Carbon\Carbon;
use DB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator;


class HomePage extends Controller
{
    public function اhome(Request $request)
    {
        $rules = [
            'key_word' => 'required|in:brands,shops,men,women',



        ];
        $validate = Validator::make(request()->all(), $rules);

        if ($validate->fails()) {

            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);

        } else {
            /*  $categories= Category::all();
              $subcategories = Subcategory::all();*/

            $keyword = $request['key_word'];
            if($keyword=="brands") {
                $brands = Brand::orderBy('order', 'desc')->get();
                $j=0;
                foreach ($brands as $brand){
                    $ads = Product::where('brand_id', $brand->id)->get();



                    $i = 0;
                foreach ($ads as $ad) {
                    $user=User::where('id',$ad->form_id)->first();
                    $image = ProductImages::where('product_id', $ad->id)->first();
                    $cat = Category::where('id', $ad->category_id)->first();
                    $scat = Subcategory::where('id', $ad->sub_category_id)->first();
                    if ($image) {
                        $ads[$i]['image'] = $image->image;
                    } else {
                        $ads[$i]['image'] = null;
                    }
                    if ($user) {
                        $ads[$i]['shop_name'] = $user->shope_name;
                    } else {
                        $ads[$i]['shop_name'] = null;

                    }
                    $ads[$i]['category_name'] = $cat->name;
                    $ads[$i]['sub_category_name'] = $scat->name;
                    $i++;

                }
                    $brands[$j]['products']=$ads;
                $j++;
            }
                return response($brands, 200);

            }
            if($keyword=="shops") {
                $users= User::where('type',2 )->get();
                $j=0;
                foreach ($users as $brand){
                    $ads = Product::where('form_id', $brand->id)->get();



                    $i = 0;
                foreach ($ads as $ad) {
                    $user=User::where('id',$ad->form_id)->first();
                    $image = ProductImages::where('product_id', $ad->id)->first();
                    $cat = Category::where('id', $ad->category_id)->first();
                    $scat = Subcategory::where('id', $ad->sub_category_id)->first();
                    if ($image) {
                        $ads[$i]['image'] = $image->image;
                    } else {
                        $ads[$i]['image'] = null;
                    }
                    if ($user) {
                        $ads[$i]['shop_name'] = $user->shope_name;
                    } else {
                        $ads[$i]['shop_name'] = null;

                    }
                    $ads[$i]['category_name'] = $cat->name;
                    $ads[$i]['sub_category_name'] = $scat->name;
                    $i++;

                }
                    $users[$j]['products']=$ads;
                $j++;
            }
                return response($users, 200);

            }
            if($keyword=="men") {
                $users= User::where('type',2 )->where('shop_for',2)->get();
                $j=0;
                foreach ($users as $brand){
                    $ads = Product::where('form_id', $brand->id)->get();



                    $i = 0;
                foreach ($ads as $ad) {
                    $user=User::where('id',$ad->form_id)->first();
                    $image = ProductImages::where('product_id', $ad->id)->first();
                    $cat = Category::where('id', $ad->category_id)->first();
                    $scat = Subcategory::where('id', $ad->sub_category_id)->first();
                    if ($image) {
                        $ads[$i]['image'] = $image->image;
                    } else {
                        $ads[$i]['image'] = null;
                    }
                    if ($user) {
                        $ads[$i]['shop_name'] = $user->shope_name;
                    } else {
                        $ads[$i]['shop_name'] = null;

                    }
                    $ads[$i]['category_name'] = $cat->name;
                    $ads[$i]['sub_category_name'] = $scat->name;
                    $i++;

                }
                    $users[$j]['products']=$ads;
                $j++;
            }
                return response($users, 200);

            }
            if($keyword=="women") {
                $users= User::where('type',2 )->where('shop_for',2)->get();
                $j=0;
                foreach ($users as $brand){
                    $ads = Product::where('form_id', $brand->id)->get();



                    $i = 0;
                foreach ($ads as $ad) {
                    $user=User::where('id',$ad->form_id)->first();
                    $image = ProductImages::where('product_id', $ad->id)->first();
                    $cat = Category::where('id', $ad->category_id)->first();
                    $scat = Subcategory::where('id', $ad->sub_category_id)->first();
                    if ($image) {
                        $ads[$i]['image'] = $image->image;
                    } else {
                        $ads[$i]['image'] = null;
                    }
                    if ($user) {
                        $ads[$i]['shop_name'] = $user->shope_name;
                    } else {
                        $ads[$i]['shop_name'] = null;

                    }
                    $ads[$i]['category_name'] = $cat->name;
                    $ads[$i]['sub_category_name'] = $scat->name;
                    $i++;

                }
                    $users[$j]['products']=$ads;
                $j++;
            }
                return response($users, 200);

            }
            }

    }
public function profile(Request $request){
    $rules = [
        'register_id' => 'required',
        'user_id' => 'required',

    ];
    $validate = Validator::make(request()->all(), $rules);

    if ($validate->fails()) {

        return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);

    } else {
        $user = User::where('id', $request->user_id)->first();
        $fo=Follow::where('form_id', $request->register_id)->where('to_id',$request->user_id)->first();
        $like=Like::where('form_id', $request->register_id)->where('to_id',$request->user_id)->first();
        $rate=Rate::where('form_id', $request->register_id)->where('to_id',$request->user_id)->first();
             $likeCount=Like::where('to_id',$request->user_id)->count();
             $followerCount=Follow::where('to_id',$request->user_id)->count();
        $fol=Follow::where('to_id',$request->user_id)->pluck('to_id')->toArray();
        $products = Product::whereIn('form_id',$fol)->paginate(10);
        if ($user == null) {
            return response(['message' => 'user not found '], 422);
        }

        if ($request->register_id &&$request->register_id!=$request->user_id) {
            if ( $fo) {
                $user["is_following"] = 1;
            } else {
                $user["is_following"] = 0;
            }
            if ( $like) {
                $user["is_like"] = 1;
            } else {
                $user["is_like"] = 0;
            }
            if ( $rate) {
                $user["can_rate"] = 1;
            } else {
                $user["can_rate"] = 0;
            }
        }else{
            $user["is_following"] = 1;
            $user["is_like"] = 1;

            $user["can_rate"] = 0;

        }

        $custom = Follow::where('to_id', $request->user_id)->pluck('form_id')->toArray();
        $c=array_unique($custom);
        $i = 0;

        $customers=[];

        foreach ($c as $customer) {
            $follower = User::where('id', $customer)->first();
            $follower ['user_name'] = $follower->name;
            $follower ['user_image'] = $follower->image;


            $customers[$i]= $follower;
            $i++;


        }
        $i = 0;




        $rates = Rate::where('to_id', $request->user_id)->get();
        $s = 0;
        foreach ($rates as $rate){
            $rated = User::where('id',$rate->form_id)->first();
            $rates[$s]['user_id'] = $rated->id;
            $rates[$s]['user_name'] = $rated->name;
            $rates[$s]['user_image'] = $rated->image;
            $s++;
        }
        $productsboth=Product::where('form_id',$user->id)->where('gender',1)->get();
        $j=0;
        foreach ($productsboth as $ad){

            $image=ProductImages::where('product_id',$ad->id)->first();
            $cat=Category::where('id',$ad->category_id)->first();
            $scat=SubCategory::where('id',$ad->sub_category_id)->first();
            if($image){
                $productsboth[$j]['product_image']=$image->image;
            }else{   $productsboth[$j]['ad_image']=null;    }
            $productsboth[$j]['ad_category_name']=$cat->name;
            $productsboth[$j]['ad_sub_category_name']=$scat->name;
            $j++;
        }
        $productsmale=Product::where('form_id',$user->id)->where('gender',2)->get();
        $j=0;
        foreach ($productsboth as $ad){

            $image=ProductImages::where('product_id',$ad->id)->first();
            $cat=Category::where('id',$ad->category_id)->first();
            $scat=SubCategory::where('id',$ad->sub_category_id)->first();
            if($image){
                $productsmale[$j]['product_image']=$image->image;
            }else{   $productsmale[$j]['ad_image']=null;    }
            $productsmale[$j]['ad_category_name']=$cat->name;
            $productsmale[$j]['ad_sub_category_name']=$scat->name;
            $j++;
        }
        $productsfemale=Product::where('form_id',$user->id)->where('gender',3)->get();
        $j=0;
        foreach ($productsfemale as $ad){

            $image=ProductImages::where('product_id',$ad->id)->first();
            $cat=Category::where('id',$ad->category_id)->first();
            $scat=SubCategory::where('id',$ad->sub_category_id)->first();
            if($image){
                $productsfemale[$j]['product_image']=$image->image;
            }else{   $productsfemale[$j]['ad_image']=null;    }
            $productsfemale[$j]['ad_category_name']=$cat->name;
            $productsfemale[$j]['ad_sub_category_name']=$scat->name;
            $j++;
        }
        $trends=Product::where('form_id',$user->id)->where('trend',1)->get();
        $j=0;
        foreach ($trends as $ad){

            $image=ProductImages::where('product_id',$ad->id)->first();
            $cat=Category::where('id',$ad->category_id)->first();
            $scat=SubCategory::where('id',$ad->sub_category_id)->first();
            if($image){
                $trends[$j]['product_image']=$image->image;
            }else{   $trends[$j]['ad_image']=null;    }
            $trends[$j]['ad_category_name']=$cat->name;
            $trends[$j]['ad_sub_category_name']=$scat->name;
            $j++;
        }

        return response(['user' => $user,

            'followers' => $customers,
            'trends' => $trends,
            'followerCount' => $followerCount,
            'rateds' => $rates,
            'likeCount' => $likeCount,
            'productsmale' => $productsmale,
            'productsfemale' => $productsfemale,
            'productsboth' => $productsboth,
        ], 200);
    }

}


}
