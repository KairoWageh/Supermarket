<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
                'name'       => 'required|min:3|unique:admins',
                'email'       => 'required|min:3|unique:admins',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024', // 1MB Max
                'password'              => 'required|min:8',
                'password_confirmation' => 'required|same:password',
            ]; 
        }

        if($this->request_type == 'update'){
            $rules = [
                'name'     => 'required|min:3|unique:admins,name,'.$this->id,
                'email'    => 'required|email|unique:admins,email,'.$this->id,
                'image'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
                'password' => 'nullable|min:8'
            ]; 
        }        
           

        return $rules;
    }
}
