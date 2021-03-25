@extends('admin.layouts.app')
@section('title')
	{{setting()->site_title}} - {{__('categories')}}
@endsection
@section('content')
	<livewire:admin.categories />
@endsection