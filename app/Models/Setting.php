<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';
    protected $fillable = [
    	'ar_title',
    	'en_title',
    	'address1',
    	'address2',
    	'phone1',
    	'phone2',
    	'logo',
    	'login_banner',
    	'image_slider',
    	'android_app',
    	'ios_app',
    	'email1',
    	'email2',
    	'link',
    	'ar_des',
    	'en_des',
    	'latitude',
    	'longitude',
    	'sms_user_name',
    	'sms_user_pass',
    	'sms_sender',
    	'publisher',
    	'company_hot_line',
    	'default_language',
    	'site_proportion'
    ];
}
