@extends('admin.layouts.app')
@section('title')
	{{setting()->site_title}} - {{__('home')}}
@endsection
@section('content')
	<livewire:admin.home />
@endsection