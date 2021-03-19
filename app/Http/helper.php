<?php
if(!function_exists('setting')){
	function setting(){
		return \App\Models\Setting::orderBy('id', 'desc')->first();
	}
}
if(!function_exists('direction')){
	function direction(){
		if(session()->has('locale')){
			if(session('locale') == 'ar'){
				return 'rtl';
			}else{
				return 'ltr';
			}
		}else{
			return 'ltr';
		}
	}
}