@extends('admin.layouts.app')
@section('title')
	{{setting()->site_title}} - {{__('users')}}
@endsection
@section('content')
	<livewire:admin.users />
@endsection