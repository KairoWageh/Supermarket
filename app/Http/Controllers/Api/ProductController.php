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


class ProductController extends Controller
{
    /*=========================== add product============================*/
    public function add_product(Request $request)
    {
        $rules = [
            'user_id' => 'required', 'category_id' => 'required',
            'subcategory_id' => 'required',

            'name' => 'required',

            'price' =>'required' ,
            'gender' =>'required' ,


            'des' => 'required|max:200',
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'


        ];
        $validate = Validator::make(request()->all(), $rules);

        if ($validate->fails()) {

            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);
        }

        $user = User::where('id', $request->user_id)->first();

        $category =Category:: where('id', $request->category_id)->first();
        $subcategories =SubCategory::where('id', $request->subcategory_id)->first();
        if (!$user) {
            return response(['message' => 'user not found '], 422);
        }
        if ($user->type!= 2) {
            return response(['message' => ' you must register as seller to add products'], 422);
        }

        if (!$category) {
            return response(['message' => 'category  not found '], 422);
        }
        if (!$subcategories) {
            return response(['message' => 'subcategories  not found '], 422);
        }


        $ad = new Product();
        $ad->form_id = $request->user_id;
        $ad->name = $request->name;
        $ad->gender = $request->gender;

        $ad->category_id = $request->category_id;
        $ad->sub_category_id = $request->subcategory_id;
        $ad->des = $request->des;
        $ad->price = $request->price;
        $ad->save();

        if ($request->hasFile('image')) {
            if ($request->image) {

                foreach ($request->image as $value) {
                    $image = new ProductImages();
                    $file = $value;
                    $path = "uploads/products";
                    $name = 'uploads/products/' . time() . $file->getClientOriginalName();
                    $file->move($path, $name);
                    $image->image = $name;

                    $image->product_id = $ad->id;
                    $image->save();
                }
            }
        if ($ad->save()) {
            $images = ProductImages::where('product_id', $ad->id)->get();


            $category = Category::where('id', $ad->category_id)->first();
            $scategory = Subcategory::where('id', $ad->sub_category_id)->first();
            $ad['category_name'] = $category->name;

            $ad['sub_category_name'] = $scategory->name;
            $ad['images'] = $images;
            return response($ad, 200);

        } else {
            return response([
                'status' => false,
                'message' => 'update fail',
            ], 500);

        }
        }
    }//validation
    public function update_product(Request $request)
    {
        $rules = [
            'product_id' => 'required',
            'user_id' => 'required',
            'category_id' => 'nullable',
            'subcategory_id' => 'nullable',

            'name' => 'nullable',

            'price' =>'nullable' ,
            'gender' =>'nullable' ,


            'des' => 'nullable|max:200',
            'image' => 'nullable',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'


        ];
        $validate = Validator::make(request()->all(), $rules);

        if ($validate->fails()) {

            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);
        }

        $user = User::where('id', $request->user_id)->first();
        $product = Product::where('id', $request->product_id)->first();
        if (!$product) {
            return response(['message' => 'product not found '], 422);
        }
        $us=User::where('id',$product->form_id)->first();
        if ($request->category_id) {
            $category = Category:: where('id', $request->category_id)->first();
            if (!$category) {
                return response(['message' => 'category  not found '], 422);
            }
        }
        if ( $request->subcategory_id) {
            $subcategories = SubCategory::where('id', $request->sub_category_id)->first();
            if (!$subcategories) {
                return response(['message' => 'subcategories  not found '], 422);
            }
        }
        if (!$user) {
            return response(['message' => 'user not found '], 422);
        }
        if ($us!=$user) {
            return response(['message' => ' unor not found'], 422);
        }

if($request->image){
    $imags = ProductImages::where('product_id',$product->id)->get();
    foreach ($imags as $imag) {
        $Image = public_path("{ $imag->image}"); // get previous image from folder
        if (File::exists($Image)) { // unlink or remove previous image from folder
            unlink($Image);
        }
       $imag->delete();
    }//endforeach
}



        $ad =  Product::where('id',$request->product_id)->first();
        if ($request->name) {
            $ad->name = $request->name;
        }
        if ($request->gender) {
            $ad->gender = $request->gender;
        }

        if ($request->category_id) {
            $ad->category_id = $request->category_id;
        }
        if ( $request->subcategory_id) {
            $ad->sub_category_id = $request->subcategory_id;
        }
        if ($request->des) {
            $ad->des = $request->des;
        }
        if ($request->price) {
            $ad->price = $request->price;
        }
        $ad->save();


        if ($request->hasFile('image')) {


            if ($request->image) {


                foreach ($request->image as $value) {
                    $image = new ProductImages();
                    $file = $value;
                    $path = "uploads/products";
                    $name = 'uploads/products/' . time() . $file->getClientOriginalName();
                    $file->move($path, $name);
                    $image->image = $name;

                    $image->product_id = $ad->id;
                    $image->save();
                }
            }
        if ($ad->save()) {
            $images = ProductImages::where('product_id', $ad->id)->get();


            $category = Category::where('id', $ad->category_id)->first();
            $scategory = Subcategory::where('id', $ad->sub_category_id)->first();
            $ad['category_name'] = $category->name;

            $ad['sub_category_name'] = $scategory->name;
            $ad['images'] = $images;
            return response($ad, 200);

        } else {
            return response([
                'status' => false,
                'message' => 'update fail',
            ], 500);

        }
        }
    }//validation



    /*=========================== update ad============================*/
    /*=========================== delete ad============================*/

    public  function delete_product (Request $request)
    {
        $rules = [
            'product_id' => 'required',
            'user_id' => 'required',


        ];
        $validate = Validator::make(request()->all(), $rules);

        if ($validate->fails()) {

            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);
        }





        $ad = Product::where('id', $request->product_id)->first();


        if ($ad == null) {
            return response(['message' => 'product not found '], 422);
        }
        $user = User::where('id', $ad->form_id)->first();
        if (!$user) {
            return response(['message' => ' ouner not found '], 422);
        }



        $imags = ProductImages::where('product_id', $ad->id)->get();
        foreach ($imags as $imag) {
            $Image = public_path("{ $imag->image}"); // get previous image from folder
            if (File::exists($Image)) { // unlink or remove previous image from folder
                unlink($Image);
            }
        }//endforeach

        $ad = Product::where('id',$request->product_id)->first();

        $ad->delete();

        return response(['message'=>'deleted ok'], 200);

        {
            return response([
                'status' => false,
                'message' => 'update fail',
            ], 500);

        }//update


    }
    public  function toggle_trend_product (Request $request)
    {
        $rules = [
            'product_id' => 'required',
            'user_id' => 'required',


        ];
        $validate = Validator::make(request()->all(), $rules);

        if ($validate->fails()) {

            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);
        }





        $ad = Product::where('id', $request->product_id)->first();


        if ($ad == null) {
            return response(['message' => 'product not found '], 422);
        }
        $user = User::where('id', $ad->form_id)->first();
        if (!$user) {
            return response(['message' => ' ouner not found '], 422);
        }
        if($ad->trend==1){
            $ad->trend=0;
            $ad->save();
            return response(['message'=>'trend off ok'], 200);

        }else{
            $ad->trend=1;
            $ad->save();
            return response(['message'=>'trend on ok'], 200);

        }






        {
            return response([
                'status' => false,
                'message' => 'update fail',
            ], 500);

        }//update


    }
    /*=========================== delet  ad image ============================*/

    public  function delete_image (Request $request)
    {
        $rules = [
            'image_id' => 'required',



        ];
        $validate = Validator::make(request()->all(), $rules);

        if ($validate->fails()) {

            return response(['status' => false, 'message' => 'this is the all errors', 'errors' => $validate->messages()], 422);
        }





        $image = Image::where('id', $request->image_id)->first();


        if ($image == null) {
            return response(['message' => 'image not found '], 422);
        }

        $Image = public_path("src/images/{ $image->image}"); // get previous image from folder
        if (File::exists($Image)) { // unlink or remove previous image from folder
            unlink($Image);

        }//endforeach



        $image->delete();

        return response(['message'=>'deleted ok'], 200);

        {
            return response([
                'status' => false,
                'message' => 'update fail',
            ], 500);

        }//update


    }
    /*=========================== end work ============================*/
}
