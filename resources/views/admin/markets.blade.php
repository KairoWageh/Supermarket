@extends('admin.layouts.app')
@section('title')
	{{setting()->site_title}} - {{__('markets')}}
@endsection
@section('content')
	<livewire:admin.markets />
@endsection