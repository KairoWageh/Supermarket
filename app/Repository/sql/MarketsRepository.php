<?php   

namespace App\Repository\sql;   

use App\Repository\contracts\MarketsRepositoryInterface; 
use App\Http\Requests\MarketRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class MarketsRepository extends BaseRepository implements MarketsRepositoryInterface 
{     

	/**
    * @param array $attributes
    *
    * @return Model
    */
    public function store($model, $attributes)
    {
    	$messages = [
            'ar_title.required'      => __('ar_title_required'),
            'ar_title.min'           => __('ar_title_min'),
            'ar_title.unique'       => __('ar_title_unique'),
            'en_title.required'      => __('en_title_required'),
            'en_title.min'           => __('en_title_min'),
            'en_title.unique'       => __('en_title_unique'),
            'email.required'     => __('email_required'),
            'email.email'        => __('email_email'),
            'email.unique'       => __('email_unique'),
            'image.required'     => __('image_required'),
            'image.image'        => __('image_image'),
            'banner.required'     => __('banner_required'),
            'banner.image'        => __('banner_image'),
            'phone_code.required' => __('phone_code_required'),
            'phone_code.regex' => __('phone_code_regex'),
            'phone.required' => __('phone_required'),
            'phone.regex' => __('phone_regex'),
            'password.required'  => __('password_required'),
            'password.min'       => __('password_min'),

		];
        $request_type = 'store';
		$adminRequest = new MarketRequest($request_type, null);
        $validator = Validator::make($attributes, $adminRequest->rules(), $messages)->validate();



        $imageName = 'image_'.$attributes['en_title'].'.'.$attributes['image']->extension(); 
        $attributes['image'] = 'images/markets/'.$imageName;
        $bannerName = 'banner_'.$attributes['en_title'].'.'.$attributes['banner']->extension(); 
        $attributes['banner'] = 'images/markets/'.$bannerName;
        $password = $attributes['password'];
        $attributes['password'] = bcrypt($password);
        // $attributes['type'] = 2;

        $market = $model->create($attributes);
        $market->image =  Storage::url('app/images/markets/').$market->image;
        $market->banner =  Storage::url('app/images/markets/').$market->banner;
        return $market;
    }

    public function update($id, $model, $attributes)
    {
        $messages = [
            'ar_title.required'      => __('ar_title_required'),
            'ar_title.min'           => __('ar_title_min'),
            'ar_title.unique'       => __('ar_title_unique'),
            'en_title.required'      => __('en_title_required'),
            'en_title.min'           => __('en_title_min'),
            'en_title.unique'       => __('en_title_unique'),
            'email.required'     => __('email_required'),
            'email.email'        => __('email_email'),
            'email.unique'       => __('email_unique'),
            'image.image'        => __('image_image'),
            'banner.image'        => __('banner_image'),
            'phone_code.required' => __('phone_code_required'),
            'phone_code.regex' => __('phone_code_regex'),
            'phone.required' => __('phone_required'),
            'phone.regex' => __('phone_regex'),
            'password.min'       => __('password_min'),

        ];
        if(isset($attributes['image']) && $attributes['image'] != null){
            $imageName = 'image_'.$attributes['en_title'].'.'.$attributes['image']->extension(); 
            $attributes['image'] = 'images/markets/'.$imageName;
        }else{
            unset($attributes['image']);
        }
        if(isset($attributes['banner'])  && $attributes['banner'] != null){
            $bannerName = 'banner_'.$attributes['en_title'].'.'.$attributes['banner']->extension(); 
            $attributes['banner'] = 'images/markets/'.$bannerName;
        }else{
            unset($attributes['banner']);
        }

        if(isset($attributes['password'])  && $attributes['password'] != null){
            $password = $attributes['password'];
            $attributes['password'] = bcrypt($password);
        }else{
            unset($attributes['password']);
        }
        $request_type = 'update';
        $marketRequest = new MarketRequest($request_type, $id);
        $validator = Validator::make($attributes, $marketRequest->rules(), $messages)->validate();
        $admin = $model::where('id', $id)->update($attributes);
        return $admin;
    }
    public function delete($id, $model){
        $admin = $model::where('id', $id)->delete();
        return $admin;
    }
}