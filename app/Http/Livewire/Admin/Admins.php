<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Admin;
use App\Repository\sql\AdminsRepository;
use Livewire\WithFileUploads;
use URL;

class Admins extends Component
{
	use WithFileUploads;
    public $admins, $admin_id, $name, $email, $admin_image, $current_image, $iteration, $password, $password_confirmation, $show_toastr, $selected_admin;
    public function render()
    {
    	$this->admins   = Admin::all();
        return view('livewire.admin.admins' , [
            'admins'   => Admin::orderBy('id', 'desc')
        ]);
    }

    public function create(){
        $this->reset('name', 'email', 'password', 'password_confirmation', 'show_toastr');
        $this->admin_image=null;

        $this->iteration++;
        $this->setErrorBag(['']);
    }

    public function store(){
        $adminsRepository = resolve(AdminsRepository::class);
        $model = resolve(Admin::class);
        if(isset($this->admin_image)){
            $imageName = $this->name.'.'.$this->admin_image->extension(); 
            $this->admin_image->storeAs('images/admins', $imageName);
        }
        $attributes = [
            'name'     => $this->name,
            'email'    => $this->email,
            'image'    => $this->admin_image,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation
        ];
        $admin = $adminsRepository->store($model, $attributes);
        if($admin == true){
            $this->emit('admin_created', $this->show_toastr);
        }else{
            $this->emit('admin_not_created', $this->show_toastr);
        }
    }

    public function edit($id){
        $this->setErrorBag(['']);
        $adminsRepository = resolve(AdminsRepository::class);
        $model = resolve(Admin::class);
        $admin = $adminsRepository->find($model, $id);

        $this->admin_id       = $id;
        $this->name           = $admin->name;
        $this->email          = $admin->email; 
        $this->current_image      = $admin->image;
        
    }

    public function update($id){
        $attributes = [
            'name'     => $this->name,
            'email'    => $this->email,
            'image'    => $this->admin_image,
            'password' => $this->password
        ];
        $adminsRepository = resolve(AdminsRepository::class);
        $model = resolve(Admin::class);
        if($attributes['image'] == null){
            unset($attributes['image']);
        }else{
            $imageName = $this->name.'.'.$this->image->extension(); 
            $this->image->storeAs('images/admins', $imageName);
        }

        if($attributes['password'] == null){
            unset($attributes['password']);
        }
        $admin = $adminsRepository->update($id, $model, $attributes);
        if($admin == true){
            $this->emit('admin_updated', $this->show_toastr);
        }else{
            $this->emit('admin_not_updated', $this->show_toastr);
        }
    }

    public function delete($id){
        $adminsRepository = resolve(AdminsRepository::class);
        $model = resolve(Admin::class);
        $this->selected_admin = $adminsRepository->find($model, $id);
        return $this->selected_admin;
    }

    public function delete_confirm($id){
        $adminsRepository = resolve(AdminsRepository::class);
        $model = resolve(Admin::class);
        $admin = $adminsRepository->delete($id, $model);
        if($admin == true){
            $this->emit('admin_deleted', $this->show_toastr);
        }else{
            $this->emit('admin_not_deleted', $this->show_toastr);
        }
    }
}
