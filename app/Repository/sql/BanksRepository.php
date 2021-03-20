<?php   

namespace App\Repository\sql;   

use App\Repository\contracts\BanksRepositoryInterface; 
use App\Http\Requests\BankRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class BanksRepository extends BaseRepository implements BanksRepositoryInterface 
{     

	/**
    * @param array $attributes
    *
    * @return Model
    */
    public function store($model, $attributes)
    {
    	$messages = [
            'account_name.required'       => __('account_name_required'),
            'account_name.min'            => __('account_name_min'),
            'account_name.unique'         => __('account_name_unique'),

            'account_number.required' => __('account_number_required'),
            'account_number.min'      => __('account_number_min'),
            'account_number.max'      => __('account_number_max'),
            
            'bank_name.required'       => __('bank_name_required'),
            'bank_name.min'            => __('bank_name_min'),
            'bank_name.unique'         => __('bank_name_unique'),

            'iban.required' => __('iban_required'),
            'iban.regex'      => __('iban_regex'),

            

            'image.required'          => __('image_required'),
            'image.image'             => __('image'),
            'image.max'               => __('image_max'),

		];
        $request_type = 'store';
		$bankRequest = new BankRequest($request_type, null);
        $validator = Validator::make($attributes, $bankRequest->rules(), $messages)->validate();
        $imageName = $attributes['name'].'.'.$attributes['image']->extension(); 
        $attributes['image'] = 'images/banks/'.$imageName;
        $bank = $model->create($attributes);
        $bank->image =  Storage::url('app/images/banks/').$bank->image;
        return $bank;
    }

    public function update($id, $model, $attributes)
    {
        $messages = [
            'account_name.required'       => __('account_name_required'),
            'account_name.min'            => __('account_name_min'),
            'account_name.unique'         => __('account_name_unique'),

            'account_number.required' => __('account_number_required'),
            'account_number.min'      => __('account_number_min'),
            'account_number.max'      => __('account_number_max'),
            
            'bank_name.required'       => __('bank_name_required'),
            'bank_name.min'            => __('bank_name_min'),
            'bank_name.unique'         => __('bank_name_unique'),

            'iban.required' => __('iban_required'),
            'iban.regex'      => __('iban_regex'),

            

            'image.image'             => __('image'),
            'image.max'               => __('image_max'),
        ];
        $request_type = 'update';
        $bankRequest = new BankRequest($request_type, $id);
        $validator = Validator::make($attributes, $bankRequest->rules(), $messages)->validate();
        if(isset($attributes['image'])){
            $imageName = $attributes['bank_name'].'.'.$attributes['image']->extension(); 
            $attributes['image'] = 'images/banks/'.$imageName;
        }

        $attributes['name'] = $attributes['account_name'];
        $attributes['number'] = $attributes['account_number'];
        unset($attributes['account_name']);
        unset($attributes['account_number']);
        $bank = $model::where('id', $id)->update($attributes);
        return $bank;
    }

    public function delete($id, $model){
        $admin = $model::where('id', $id)->delete();
        return $admin;
    }
}