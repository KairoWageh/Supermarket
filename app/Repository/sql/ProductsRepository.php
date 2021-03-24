<?php   

namespace App\Repository\sql;   

use App\Repository\contracts\ProductsRepositoryInterface; 
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use DB;


class ProductsRepository extends BaseRepository implements ProductsRepositoryInterface 
{     

	/**
    * @param array $attributes
    *
    * @return Model
    */
    public function store($model, $attributes)
    {
    	$messages = [
            'ar_title.required'       => __('ar_title_required'),
            'ar_title.min'            => __('ar_title_min'),
            'ar_title.unique'         => __('ar_title_unique'),
            
            'en_title.required'       => __('en_title_required'),
            'en_title.min'            => __('en_title_min'),
            'en_title.unique'         => __('en_title_unique'),

            'ar_des.required' => __('ar_description_required'),
            'ar_des.min'      => __('ar_description_min'),
            'en_des.required' => __('en_description_required'),
            'en_des.min'      => __('en_description_min'),

            'image.required'          => __('image_required'),
            'image.image'             => __('image'),
            'image.max'               => __('image_max'),
            'images.required'          => __('images_required'),
            'images.image'             => __('images'),
            'images.max'               => __('images_max'),
            'price.required'          => __('price_required'),
            'price.numeric'           => __('price_numeric'),
            'price.min'               => __('price_min'),
            'quntity.required'        => __('quntity_required'),
            'quntity.numeric'         => __('quntity_numeric'),
            'quntity.min'             => __('quntity_min'),
            'category_id.required'        => __('category_id_required'),

		];
        $request_type = 'store';
		$productRequest = new ProductRequest($request_type, null);
        $validator = Validator::make($attributes, $productRequest->rules(), $messages)->validate();
        // $imageName = $attributes['en_title'].'.'.$attributes['image']->extension();  

        // $attributes['image']->move(public_path('images/categories'), $imageName);
        $imageName = 'main_image_'.$attributes['en_title'].'.'.$attributes['image']->extension(); 
        $attributes['image'] = 'images/products/'.$imageName;
        

        
        $product = $model->create($attributes);

        $product->image =  Storage::url('app/images/products/').$product->image;
        foreach($attributes['images'] as $image){
            for($i=0; $i<count($attributes['images']); $i++){
                $imageName = $i.'_sub_image_'.$attributes['en_title'].'.'.$image->extension(); 
                Storage::url('app/images/products/').$imageName;
                DB::table('product_images')->insert([
                    'image' => $imageName,
                    'product_id' => $product->id
                ]);
            }
        }

        
       //$category = $model->create($attributes);

        return $product;
    }

    public function update($id, $model, $attributes)
    {
        $messages = [
            'ar_title.required'       => __('ar_title_required'),
            'ar_title.min'            => __('ar_title_min'),
            'ar_title.unique'         => __('ar_title_unique'),
            
            'en_title.required'       => __('en_title_required'),
            'en_title.min'            => __('en_title_min'),
            'en_title.unique'         => __('en_title_unique'),

            'ar_description.required' => __('ar_description_required'),
            'ar_description.min'      => __('ar_description_min'),
            'en_description.required' => __('en_description_required'),
            'en_description.min'      => __('en_description_min'),

            'price.required'          => __('price_required'),
            'price.numeric'           => __('price_numeric'),
            'price.min'               => __('price_min'),
            'quntity.required'        => __('quntity_required'),
            'quntity.numeric'         => __('quntity_numeric'),
            'quntity.min'             => __('quntity_min'),
        ];
        $request_type = 'update';
        $productRequest = new ProductRequest($request_type, $id);
        $validator = Validator::make($attributes, $productRequest->rules(), $messages)->validate();
        $product = $model->find($id);
        if(isset($attributes['image'])){
            $imageName = $attributes['en_title'].'.'.$attributes['image']->extension(); 
            $attributes['image'] = 'images/categories/'.$imageName;
        }
        
        $model::where('id', $id)->update($attributes);
        return $product;
    }

    public function delete($id, $model){
        $admin = $model::where('id', $id)->delete();
        return $admin;
    }
}