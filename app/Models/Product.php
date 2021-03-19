<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ar_title',
        'en_title',
        'ar_des',
        'en_des',
        'image',
        'price',
        'quntity',
        'category_id'        
    ];

    function getProductTitleAttribute() {
        if(Session::get('locale') == 'ar')
            $title = $this->ar_title;
        else
            $title = $this->en_title;
        return sprintf('%s', $title);
    }

    function getProductDescriptionAttribute() {
        if(Session::get('locale') == 'ar')
            $description = $this->ar_des;
        else
            $description = $this->en_des;
        return sprintf('%s', $description);
    }
}
