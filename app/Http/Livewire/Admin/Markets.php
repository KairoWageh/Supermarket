<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Repository\sql\MarketsRepository;
use Livewire\WithFileUploads;

class Markets extends Component
{
	use WithFileUploads;
    public $markets, $market_id, $ar_title, $en_title, $market_image, $current_image, $iteration, $banner, $current_banner, $phone_code, $phone, $email, $password, $show_toastr, $selected_market;

    public function render()
    {
    	$this->markets   = User::where('type', 2)->get();
        return view('livewire.admin.markets' , [
            'markets'   => $this->markets
        ]);
    }

    public function create(){
        $this->reset('ar_title', 'en_title', 'phone_code', 'phone', 'email', 'password', 'show_toastr');
        $this->market_image=null;

        $this->iteration++;
        $this->setErrorBag(['']);
    }

    public function store(){
        $marketsRepository = resolve(MarketsRepository::class);
        $model = resolve(User::class);
        if(isset($this->market_image)){
            $imageName = 'image_'.$this->en_title.'.'.$this->market_image->extension(); 
            $this->market_image->storeAs('images/markets', $imageName);
        }
        if(isset($this->banner)){
            $imageName = 'banner_'.$this->en_title.'.'.$this->market_image->extension(); 
            $this->market_image->storeAs('images/markets', $imageName);
        }
        $attributes = [
            'ar_title'   => $this->ar_title,
            'en_title'   => $this->en_title,
            'image'      => $this->market_image,
            'banner'     => $this->banner,
            'phone_code' => $this->phone_code,
            'phone'      => $this->phone,
            'email'      => $this->email,
            'password'   => $this->password,
            'type'       => 2
        ];
        $market = $marketsRepository->store($model, $attributes);
        if($market == true){
            $this->emit('market_created', $this->show_toastr);
        }else{
            $this->emit('market_not_created', $this->show_toastr);
        }
    }

    public function edit($id){
        $this->setErrorBag(['']);
        $marketsRepository = resolve(MarketsRepository::class);
        $model = resolve(User::class);
        $market = $marketsRepository->find($model, $id);
        $this->market_id = $id;
        $this->ar_title    = $market->ar_title;
        $this->en_title    = $market->en_title;
        $this->current_image   = $market->image;
        $this->current_banner   = $market->banner;

        $this->phone_code    = $market->phone_code;
        $this->phone    = $market->phone;
        $this->current_image   = $market->image;
        $this->email   = $market->email;

    }

    public function update($id){
        $attributes = [
            'ar_title'   => $this->ar_title,
            'en_title'   => $this->en_title,
            'image'      => $this->market_image,
            'banner'     => $this->banner,
            'phone_code' => $this->phone_code,
            'phone'      => $this->phone,
            'email'      => $this->email,
            'password'   => $this->password
        ];
        $marketsRepository = resolve(MarketsRepository::class);
        $model = resolve(User::class);
        if(isset($this->market_image)){
            $imageName = 'image_'.$this->en_title.'.'.$this->market_image->extension(); 
            $this->market_image->storeAs('images/markets', $imageName);
        }
        if(isset($this->banner)){
            $imageName = 'banner_'.$this->en_title.'.'.$this->market_image->extension(); 
            $this->market_image->storeAs('images/markets', $imageName);
        }
        $market = $marketsRepository->update($id, $model, $attributes);
        if($market == true){
            $this->emit('market_updated', $this->show_toastr);
        }else{
            $this->emit('market_not_updated', $this->show_toastr);
        }
    }

    public function delete($id){
        $marketsRepository = resolve(MarketsRepository::class);
        $model = resolve(User::class);
        $this->selected_market = $marketsRepository->find($model, $id);
        return $this->selected_market;
    }

    public function delete_confirm($id){
        $marketsRepository = resolve(MarketsRepository::class);
        $model = resolve(User::class);
        // $products = Product::where('category_id', $id)->get();
        // if(count($products) > 0){
        //     $this->emit('category_has_products', $this->show_toastr);
        // }else{
            $market = $marketsRepository->delete($id, $model);
            if($market == true){
                $this->emit('market_deleted', $this->show_toastr);
            }else{
                $this->emit('market_not_deleted', $this->show_toastr);
            }
        // }
        
    }
}
