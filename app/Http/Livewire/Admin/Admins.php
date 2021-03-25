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
    public $admin_id, $name, $email, $admin_image, $current_image, $iteration, $password, $password_confirmation, $show_toastr, $selected_admin;
    public function render()
    {
        $this->iteration = 0;
    	$adminsRepository = resolve(AdminsRepository::class);
        $model = resolve(Admin::class);
        $admins = $adminsRepository->all($model);
        return view('livewire.admin.admins', compact('admins'));
    }

    public function create(){
        $this->reset('name', 'email', 'password', 'iteration', 'password_confirmation', 'show_toastr', 'selected_admin');
        $this->admin_image=null;

        $this->iteration++;
        $this->setErrorBag(['']);
    }

    public function store(){
        $adminsRepository = resolve(AdminsRepository::class);
        $model = resolve(Admin::class);
        
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
        $this->reset('selected_admin');
        $this->setErrorBag(['']);
        $adminsRepository = resolve(AdminsRepository::class);
        ///dd($adminsRepository);
        $model = resolve(Admin::class);
        $admin = $adminsRepository->find($model, $id);

        

        $this->admin_id      = $id;
        $this->name          = $admin->name;
        $this->email         = $admin->email; 
        $this->image         = $admin->image;
        $this->current_image = $admin->image;
        
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
            $imageName = $attributes['name'].'.'.$attributes['image']->extension(); 
            $attributes['image']->storeAs('images/admins', $imageName);
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
        $this->reset('selected_admin');
        $adminsRepository = resolve(AdminsRepository::class);
        $model = resolve(Admin::class);
        $this->selected_admin = $adminsRepository->find($model, $id);
        //dd($this->selected_admin);
        return $this->selected_admin;
    }

    public function delete_confirm($id){
        $adminsRepository = resolve(AdminsRepository::class);
        $model = resolve(Admin::class);
        $admin = $adminsRepository->delete($id, $model);
        $this->reset('selected_admin');
        if($admin == true){
            $this->emit('admin_deleted', $this->show_toastr);
        }else{
            $this->emit('admin_not_deleted', $this->show_toastr);
        }
    }
}
