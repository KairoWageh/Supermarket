@extends('admin.layouts.app')
@section('title')
	{{setting()->site_title}} - {{__('settings')}}
@endsection
@section('content')
	<livewire:admin.settings />
@endsection