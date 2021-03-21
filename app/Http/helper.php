<?php
if(!function_exists('setting')){
	function setting(){
		return \App\Models\Setting::orderBy('id', 'desc')->first();
	}
}
if(!function_exists('lang')){
	function lang(){
		if(session()->has('locale')){
			return session('locale');
		}else{
			Session::put('locale', setting()->default_language);
			return session('locale');
		}
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