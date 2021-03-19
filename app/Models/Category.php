<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;

class Category extends Model
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
        'image',
        'des',
        
    ];

    function getCategoryTitleAttribute() {
        if(Session::get('locale') == 'ar')
            $title = $this->ar_title;
        else
            $title = $this->en_title;
        return sprintf('%s', $title);
    }
}
