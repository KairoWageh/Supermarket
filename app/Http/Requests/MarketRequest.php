<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MarketRequest extends FormRequest
{

    protected $request_type;
    protected $id;

    public function __construct($request_type, $id){
        $this->request_type = $request_type;
        $this->id = $id;
    }
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
        if($this->request_type == 'store'){
            $rules = [
                'ar_title'    => 'required|min:3|unique:users',
                'en_title'    => 'required|min:3|unique:users',
                'image'       => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',  // 1MB Max
                'banner'       => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',  // 1MB Max
                'phone_code' => 'required|regex:/^([+ 0-9\s\-\+\(\)]*)$/|min:2',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'email'       => 'required|email|unique:users',
                'password'              => 'required|min:8'
                ]; 
        }

        if($this->request_type == 'update'){
            $rules = [
                'ar_title'    => 'required|min:3|unique:users,ar_title,'.$this->id,
                'en_title'    => 'required|min:3|unique:users,en_title,'.$this->id,
                'image'       => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',  // 1MB Max
                'banner'       => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',  // 1MB Max
                'phone_code' => 'required|regex:/^([+ 0-9\s\-\+\(\)]*)$/|min:2',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'email'       => 'required|email|unique:users,email,'.$this->id,
                'password'              => 'min:8'
            ]; 
        }        
           

        return $rules;
    }
}
