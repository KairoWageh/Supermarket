<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Setting;
use App\Repository\sql\SettingsRepository;
use Livewire\WithFileUploads;

class Settings extends Component
{
	use WithFileUploads;
    public $settings_id, $ar_title, $en_title, $ar_description, $en_description, $logo, $current_logo, $iteration, $email1, $email2, $address1, $address2, $phone1, $phone2, $default_language, $show_toastr;

    public function render()
    {
    	$settings =  Setting::all()->first();
    	$this->settings_id = $settings->id;

    	if($settings->default_language == 'ar'){
    		$language = 'العربية';
    	}else{
    		$language = 'English';
    	}
    	
        return view('livewire.admin.settings', compact('language'));
    }

    public function edit($id){
        $this->setErrorBag(['']);
        $settings =  Setting::all()->first();

        $this->ar_title         = $settings->ar_title;
        $this->en_title         = $settings->en_title;
        $this->ar_description   = $settings->ar_des;
        $this->en_description   = $settings->en_des;
        $this->current_logo     = $settings->logo;
        $this->email1           = $settings->email1;
        $this->email2           = $settings->email2;
        $this->address1         = $settings->address1;
        $this->address2         = $settings->address2;
        $this->phone1           = $settings->phone1;
        $this->phone2           = $settings->phone2;
        $this->default_language = $settings->default_language;
    }

    public function update($id){
    	$attributes = [
            'ar_title'   => $this->ar_title,
            'en_title' => $this->en_title,
            'ar_des'      => $this->ar_description,
            'en_des'           => $this->en_description,
            'logo'          => $this->logo,
            'email1' =>  $this->email1,
            'email2' => $this->email2,
            'address1' => $this->address1,
            'address2' => $this->address2,
            'phone1' => $this->phone1,
            'phone2' => $this->phone2,
            'default_language' => $this->default_language,
        ];

    	$settingsRepository = resolve(SettingsRepository::class);
        $model = resolve(Setting::class);
        if($attributes['logo'] == null){
            unset($attributes['logo']);
        }else{
            $imageName = $this->en_title.'.'.$attributes['logo']->extension(); 
            $attributes['logo']->storeAs('images/settings', $imageName);
        }
        
       	$settings = $settingsRepository->update($id, $model, $attributes);
        if($settings == true){
            $this->emit('settings_updated', $this->show_toastr);
        }else{
            $this->emit('settings_not_updated', $this->show_toastr);
        }
    }
}
