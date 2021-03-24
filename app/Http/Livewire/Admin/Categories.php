<?php
namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use App\Models\User;
use App\Models\Product;
use App\Repository\sql\CategoriesRepository;
use Livewire\WithFileUploads;
use URL;

class Categories extends Component
{
    use WithFileUploads;

	public $categories, $ar_title, $en_title, $image, $current_image, $iteration, $type, $market, $level, $category, $markets, $des, $category_id, $delete_category, $show_toastr;

    public function render()
    {
        $this->iteration = 0;
        $this->categories = Category::all();
        $this->markets = User::where('type', 2)->get();
        $categories_count = count($this->categories);
        $markets_count = count($this->markets);
        foreach ($this->categories as $category) {
            // loop all images to add prefix url to image
            $category->image =  'app/'.$category->image;
        }
        return view('livewire.admin.categories', compact('categories_count', 'markets_count'));
    }

    public function create(){
        $this->reset('ar_title', 'en_title', 'type', 'market', 'level', 'category', 'des', 'show_toastr');
        $this->image=null;
        $this->iteration++;
        $this->setErrorBag(['']);
    }

    public function store(){
    	$categoriesRepository = resolve(CategoriesRepository::class);
        $model = resolve(Category::class);
        if(isset($this->image)){
            $imageName = $this->en_title.'.'.$this->image->extension(); 
            $this->image->storeAs('images/categories', $imageName);
        }
        
        $attributes = [
        	'ar_title' => $this->ar_title,
        	'en_title' => $this->en_title,
            'image'    => $this->image,
            'type'     => $this->type,
            'market'   =>  $this->market,
            'level'    =>  $this->level,
            'category' =>  $this->category,
        	'des'      => $this->des,
        ];
    	$category = $categoriesRepository->store($model, $attributes);
        if($category == true){
            $this->emit('category_created', $this->show_toastr);
        }else{
            $this->emit('category_not_created', $this->show_toastr);
        }
    }

    public function edit($id){
        $this->setErrorBag(['']);
        $categoryRepository = resolve(CategoriesRepository::class);
        $model = resolve(Category::class);
        $category = $categoryRepository->find($model, $id);
        $this->category_id = $id;
        $this->ar_title    = $category->ar_title;
        $this->en_title    = $category->en_title;
        $this->current_image   = $category->image;
        $this->des = $category->des;
    }

    public function update($id){
        $attributes = [
            'ar_title' => $this->ar_title,
            'en_title' => $this->en_title,
            'image'    => $this->image,
            'des'      => $this->des,
        ];
        $categoryRepository = resolve(CategoriesRepository::class);
        $model = resolve(Category::class);
        if($attributes['image'] == null){
            unset($attributes['image']);
        }else{
            $imageName = $this->en_title.'.'.$this->image->extension(); 
            $this->image->storeAs('images/categories', $imageName);
        }
        
        $category = $categoryRepository->update($id, $model, $attributes);
        if($category == true){
            $this->emit('category_updated', $this->show_toastr);
        }else{
            $this->emit('category_not_updated', $this->show_toastr);
        }
    }

    public function delete($id){
        $categoryRepository = resolve(CategoriesRepository::class);
        $model = resolve(Category::class);
        $this->delete_category = $categoryRepository->find($model, $id);
        return $this->delete_category;
    }

    public function delete_confirm($id){
        $categoryRepository = resolve(CategoriesRepository::class);
        $model = resolve(Category::class);
        $products = Product::where('category_id', $id)->get();
        if(count($products) > 0){
            $this->emit('category_has_products', $this->show_toastr);
        }else{
            $category = $categoryRepository->delete($id, $model);
            if($category == true){
                $this->emit('category_deleted', $this->show_toastr);
            }else{
                $this->emit('category_not_deleted', $this->show_toastr);
            }
        }
        
    }
}
