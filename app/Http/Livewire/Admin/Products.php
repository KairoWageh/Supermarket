<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use App\Repository\sql\ProductsRepository;
use Livewire\WithFileUploads;
use URL;

class Products extends Component
{
    use WithFileUploads;
    public $products, $categories, $ar_title, $en_title, $ar_description, $en_description, $product_image, $current_image, $iteration, $price, $quntity, $category_id, $product_id, $selected_product, $show_toastr;
    public function render()
    {
        $this->products   = Product::all();
        $this->categories = Category::all();
        return view('livewire.admin.products', [
            'products'   => Product::orderBy('id', 'desc'),
            'categories' => Category::orderBy('id', 'desc')
        ]);
    }

    public function create(){
        $this->reset('ar_title', 'en_title', 'ar_description', 'en_description', 'show_toastr');
        $this->product_image=null;

        $this->iteration++;
        $this->setErrorBag(['']);
    }

    public function store(){
        $productsRepository = resolve(ProductsRepository::class);
        $model = resolve(Product::class);
        if(isset($this->product_image)){
            $imageName = $this->en_title.'.'.$this->product_image->extension(); 
            $this->product_image->storeAs('images/products', $imageName);
        }
        
        $attributes = [
            'ar_title'    => $this->ar_title,
            'en_title'    => $this->en_title,
            'ar_des'      => $this->ar_description,
            'en_des'      => $this->en_description,
            'image'       => $this->product_image,
            'price'       => $this->price,
            'quntity'     => $this->quntity,
            'category_id' => $this->category_id,
        ];
        $product = $productsRepository->store($model, $attributes);
        if($product == true){
            $this->emit('product_created', $this->show_toastr);
        }else{
            $this->emit('product_not_created', $this->show_toastr);
        }
    }

    public function edit($id){
        $this->setErrorBag(['']);
        $productRepository = resolve(ProductsRepository::class);
        $model = resolve(Product::class);
        $product = $productRepository->find($model, $id);

        $this->product_id     = $id;
        $this->ar_title       = $product->ar_title;
        $this->en_title       = $product->en_title;
        $this->ar_description = $product->ar_des;
        $this->en_description = $product->en_des;
        $this->current_image      = $product->image;
        $this->price          = $product->price;
        $this->quntity        =  $product->quntity;
    }

    public function update($id){
        $attributes = [
            'ar_title'    => $this->ar_title,
            'en_title'    => $this->en_title,
            'ar_des'      => $this->ar_description,
            'en_des'      => $this->en_description,
            'image'       => $this->product_image,
            'price'       => $this->price,
            'quntity'     => $this->quntity,
            'category_id' => $this->category_id,
        ];
        $productRepository = resolve(ProductsRepository::class);
        $model = resolve(Product::class);
        if($attributes['image'] == null){
            unset($attributes['image']);
        }else{
            $imageName = $this->en_title.'.'.$this->image->extension(); 
            $this->image->storeAs('images/categories', $imageName);
        }
        
        $product = $productRepository->update($id, $model, $attributes);
        if($product == true){
            $this->emit('product_updated', $this->show_toastr);
        }else{
            $this->emit('product_not_updated', $this->show_toastr);
        }
    }

    public function delete($id){
        $productsRepository = resolve(ProductsRepository::class);
        $model = resolve(Product::class);
        $this->selected_product = $productsRepository->find($model, $id);
        return $this->selected_product;
    }

    public function delete_confirm($id){
        $productsRepository = resolve(ProductsRepository::class);
        $model = resolve(Product::class);
        $product = $productsRepository->delete($id, $model);
        if($product == true){
            $this->emit('product_deleted', $this->show_toastr);
        }else{
            $this->emit('product_not_deleted', $this->show_toastr);
        }
    }
}
