@extends('admin.layouts.app')
@section('title')
	{{setting()->site_title}} - {{__('banks')}}
@endsection
@section('content')
	<livewire:admin.banks />
@endsection