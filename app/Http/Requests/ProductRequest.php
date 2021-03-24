<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
                'ar_title'       => 'required|min:3|unique:products',
                'en_title'       => 'required|min:3|unique:products',
                'ar_des' => 'required|min:50',
                'en_des' => 'required|min:50',
                'image'          => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024', // 1MB Max
                'images.*'       => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
                'price'          => 'required|numeric|min:1',
                'quntity'        => 'required|numeric|min:1',
                'category_id'        => 'required',
            ]; 
        }

        if($this->request_type == 'update'){
            $rules = [
                'ar_title'    => 'required|min:3|unique:products,ar_title,'.$this->id,
                'en_title'    => 'required|min:3|unique:products,en_title,'.$this->id,
                'ar_des' => 'required|min:50',
                'en_des' => 'required|min:50',
                'image'          => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024', // 1MB Max
                'images.*'          => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
                'price'          => 'required|numeric|min:1',
                'quntity'        => 'required|numeric|min:1',
                'category_id'        => 'required',
            ]; 
        }        
           

        return $rules;
    }
}
