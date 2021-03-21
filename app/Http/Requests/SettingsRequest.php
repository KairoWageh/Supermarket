<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingsRequest extends FormRequest
{
    
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        
        $rules = [
            'ar_title'       => 'required|min:3',
            'en_title'       => 'required|min:3',
            'ar_des' => 'required|min:50',
            'en_des' => 'required|min:50',
            'logo'          => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024', // 1MB Max
            'email1'          => 'required',
            'email2' => 'required',
            'phone1'          => 'required',
            'phone2' => 'required',
            'default_language' =>  'required'
        ]; 
        
        return $rules;
    }
}
