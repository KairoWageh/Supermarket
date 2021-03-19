<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Banks extends Component
{
    public function render()
    {
        return view('livewire.admin.banks');
    }

    public function create(){
        $this->reset('name', 'email', 'password', 'password_confirmation', 'show_toastr');
        $this->admin_image=null;

        $this->iteration++;
        $this->setErrorBag(['']);
    }
}
