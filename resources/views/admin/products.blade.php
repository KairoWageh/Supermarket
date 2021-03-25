@extends('admin.layouts.app')
@section('title')
	{{setting()->site_title}} - {{__('products')}}
@endsection
@section('content')
	<livewire:admin.products />
@endsection