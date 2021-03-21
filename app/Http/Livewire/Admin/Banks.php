<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Bank;
use App\Repository\sql\BanksRepository;
use Livewire\WithFileUploads;

class Banks extends Component
{
    use WithFileUploads;
    public $banks, $account_name, $account_number, $bank_name, $iban, $bank_image, $current_image, $iteration,$bank_id, $delete_bank, $show_toastr;

    public function render()
    {
        $this->banks = Bank::all();
        return view('livewire.admin.banks', [
            'banks' => Bank::orderBy('id', 'desc')
        ]);
    }

    public function create(){
        $this->reset('account_name', 'account_number', 'bank_name', 'iban', 'show_toastr');
        $this->bank_image=null;

        $this->iteration++;
        $this->setErrorBag(['']);
    }

    public function store(){
        $banksRepository = resolve(BanksRepository::class);
        $model = resolve(Bank::class);
        if(isset($this->bank_image)){
            $imageName = $this->bank_name.'.'.$this->bank_image->extension(); 
            $this->bank_image->storeAs('images/banks', $imageName);
        }
        
        $attributes = [
            'account_name'   => $this->account_name,
            'account_number' => $this->account_number,
            'bank_name'      => $this->bank_name,
            'iban'           => $this->iban,
            'image'          => $this->bank_image,
        ];
        $bank = $banksRepository->store($model, $attributes);
        if($bank == true){
            $this->emit('bank_created', $this->show_toastr);
        }else{
            $this->emit('bank_not_created', $this->show_toastr);
        }
    }
    public function edit($id){
        $this->setErrorBag(['']);
        $banksRepository = resolve(BanksRepository::class);
        $model = resolve(Bank::class);
        $bank = $banksRepository->find($model, $id);
        $this->bank_id        = $id;
        $this->account_name   = $bank->name;
        $this->account_number = $bank->number;
        $this->bank_name      = $bank->bank_name;
        $this->iban           = $bank->iban;
        $this->current_image      = $bank->image;
    }

    public function update($id){
        $attributes = [
            'account_name'   => $this->account_name,
            'account_number' => $this->account_number,
            'bank_name'      => $this->bank_name,
            'iban'           => $this->iban,
            'image'          => $this->bank_image,
        ];
        $banksRepository = resolve(BanksRepository::class);
        $model = resolve(Bank::class);

        if($attributes['image'] == null){
            unset($attributes['image']);
        }else{
            $imageName = $this->bank_name.'.'.$this->image->extension(); 
            $this->image->storeAs('images/banks', $imageName);
        }
        $bank = $banksRepository->update($id, $model, $attributes);
        if($bank == true){
            $this->emit('bank_updated', $this->show_toastr);
        }else{
            $this->emit('bank_not_updated', $this->show_toastr);
        }
    }

    public function delete($id){
        $banksRepository = resolve(BanksRepository::class);
        $model = resolve(Bank::class);
        $this->delete_bank = $banksRepository->find($model, $id);
        return $this->delete_bank;
    }

    public function delete_confirm($id){
        $banksRepository = resolve(BanksRepository::class);
        $model = resolve(Bank::class);
        $bank = $banksRepository->delete($id, $model);
        if($bank == true){
            $this->emit('bank_deleted', $this->show_toastr);
        }else{
            $this->emit('bank_not_deleted', $this->show_toastr);
        }
    }
}
