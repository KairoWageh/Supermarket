<?php   

namespace App\Repository\sql;   

use App\Repository\contracts\AdminsRepositoryInterface; 
use App\Http\Requests\AdminRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class AdminsRepository extends BaseRepository implements AdminsRepositoryInterface 
{     

	/**
    * @param array $attributes
    *
    * @return Model
    */
    public function store($model, $attributes)
    {
    	$messages = [
            'name.required'      => __('name_required'),
            'name.min'           => __('name_min'),
            'name.unique'       => __('name_unique'),
            'email.required'     => __('email_required'),
            'email.email'        => __('email_email'),
            'email.unique'       => __('email_unique'),
            'image.required'     => __('image_required'),
            'image.image'        => __('image_image'),
            'password.required'  => __('password_required'),
            'password.min'       => __('password_min'),
            'password_confirmation.required' => __('password_confirmation_required'),
            'password_confirmation.same' => __('password_confirmation_same'),

		];
        $request_type = 'store';
		$adminRequest = new AdminRequest($request_type, null);
        $validator = Validator::make($attributes, $adminRequest->rules(), $messages)->validate();

        $imageName = $attributes['name'].'.'.$attributes['image']->extension(); 
        $attributes['image'] = 'images/admins/'.$imageName;
        $password = $attributes['password'];
        $attributes['password'] = bcrypt($password);
        $admin = $model->create($attributes);

        $admin->image =  Storage::url('app/images/admins/').$admin->image;
        return $admin;
    }

    public function update($id, $model, $attributes)
    {
        $messages = [
            'name.required'      => __('name_required'),
            'name.min'           => __('name_min'),
            'name.unique'       => __('name_unique'),
            'email.required'     => __('email_required'),
            'email.email'        => __('email_email'),
            'email.unique'       => __('email_unique'),
            'image.image'        => __('image_image'),
            'password.min'       => __('password_min'),

        ];
        $request_type = 'update';
        $adminRequest = new AdminRequest($request_type, $id);
        $validator = Validator::make($attributes, $adminRequest->rules(), $messages)->validate();
        if(isset($attributes['image'])){
            $imageName = $attributes['name'].'.'.$attributes['image']->extension(); 
            $attributes['image'] = 'images/admins/'.$imageName;
        }else{
            unset($attributes['image']);
        }
        if(isset($attributes['password'])){
            $password = $attributes['password'];
            $attributes['password'] = bcrypt($password);
        }else{
            unset($attributes['password']);
        }
        $admin = $model::where('id', $id)->update($attributes);
        return $admin;
    }
    public function delete($id, $model){
        $admin = $model::where('id', $id)->delete();
        return $admin;
    }
}