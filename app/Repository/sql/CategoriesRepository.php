<?php   

namespace App\Repository\sql;   

use App\Repository\contracts\CategoriesRepositoryInterface; 
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class CategoriesRepository extends BaseRepository implements CategoriesRepositoryInterface 
{     

	/**
    * @param array $attributes
    *
    * @return Model
    */
    public function store($model, $attributes)
    {
    	$messages = [
            'ar_title.required'    => __('ar_title_required'),
            'ar_title.min'         => __('ar_title_min'),
            'ar_title.unique'      => __('ar_title_unique'),
            'en_title.required'    => __('en_title_required'),
            'en_title.min'         => __('en_title_min'),
            'en_title.unique'      => __('en_title_unique'),
            'image.required'       => __('image_required'),
            'image.image'          => __('image_image'),
            'image.max'            => __('image_max'),
            'des.required' => __('description_required'),
            'des.min'      => __('description_min'),
		];
        $request_type = 'store';

		$categoryRequest = new CategoryRequest($request_type, null);
        $validator = Validator::make($attributes, $categoryRequest->rules(), $messages)->validate();
        // $imageName = $attributes['en_title'].'.'.$attributes['image']->extension();  

        // $attributes['image']->move(public_path('images/categories'), $imageName);
        $imageName = $attributes['en_title'].'.'.$attributes['image']->extension(); 
        $attributes['image'] = 'images/categories/'.$imageName;
        $category = $model->create($attributes);

        $category->image =  Storage::url('app/images/categories/').$category->image;


       //$category = $model->create($attributes);

        return $category;
    }

    public function update($id, $model, $attributes)
    {
        $messages = [
            'ar_title.required'      => __('ar_title_required'),
            'ar_title.min'           => __('ar_title_min'),
            'ar_title.unique' => __('ar_title_unique'),
            'en_title.required'      => __('en_title_required'),
            'en_title.min'           => __('en_title_min'),
            'en_title.unique' => __('en_title_unique'),
        ];
        $request_type = 'update';
        $categoryRequest = new CategoryRequest($request_type, $id);
        $validator = Validator::make($attributes, $categoryRequest->rules(), $messages)->validate();
        $role = $model->find($id);
        if(isset($attributes['image'])){
            $imageName = $attributes['en_title'].'.'.$attributes['image']->extension(); 
            $attributes['image'] = 'images/categories/'.$imageName;
        }
        
        $model::where('id', $id)->update($attributes);
        return $role;
    }

    public function delete($id, $model){
        $admin = $model::where('id', $id)->delete();
        return $admin;
    }
}