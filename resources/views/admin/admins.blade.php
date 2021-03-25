@extends('admin.layouts.app')
@section('title')
	{{setting()->site_title}} - {{__('admins')}}
@endsection
@section('content')
	<livewire:admin.admins />
@endsection