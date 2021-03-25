@extends('admin.layouts.app')
@section('title')
	{{setting()->site_title}} - {{__('orders')}}
@endsection
@section('content')
	<livewire:admin.orders />
@endsection