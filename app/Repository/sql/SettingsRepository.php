<?php   

namespace App\Repository\sql;   

use App\Repository\contracts\SettingsRepositoryInterface; 
use App\Http\Requests\SettingsRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class SettingsRepository extends BaseRepository implements SettingsRepositoryInterface 
{     

	/**
    * @param array $attributes
    *
    * @return Model
    */
    public function update($id, $model, $attributes)
    {
        $messages = [
            'ar_title.required'       => __('ar_title_required'),
            'ar_title.min'            => __('ar_title_min'),

            'en_title.required'       => __('en_title_required'),
            'en_title.min'            => __('en_title_min'),

            'ar_description.required' => __('ar_description_required'),
            'ar_description.min'      => __('ar_description_min'),
            'en_description.required' => __('en_description_required'),
            'en_description.min'      => __('en_description_min'),
            'logo.required'           => __('logo_required'),
            'logo.image'              => __('logo_image'),

            'email1.required'          => __('email1_required'),
            'email2.required'        => __('email2_required'),
            'phone1.required'          => __('phone1_required'),
            'phone2.required'        => __('phone2_required'),
        ];
        $settingsRequest = new SettingsRequest();
        $validator = Validator::make($attributes, $settingsRequest->rules(), $messages)->validate();
        if(isset($attributes['logo'])){
            $imageName = $attributes['en_title'].'.'.$attributes['logo']->extension(); 
            $attributes['logo'] = 'images/settings/'.$imageName;
        }
        $settings = $model::where('id', $id)->update($attributes);
        return $settings;
    }
}