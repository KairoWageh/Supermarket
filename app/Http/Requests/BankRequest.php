<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BankRequest extends FormRequest
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
        $rules = [
                'account_name'      => 'required|min:3',
                'account_number'    => 'required|min:10|max:15',
                'bank_name' => 'required|min:3',
                'iban'      => 'required|regex:/(EG)[0-9]{27}/'
            ];
        if($this->request_type == 'store'){
            $rules += [
                'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024', // 1MB Max
            ]; 
        }
        if($this->request_type == 'update'){
            $rules += [
                'image'     => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024', // 1MB Max
            ]; 
        }        
        return $rules;
    }
}
