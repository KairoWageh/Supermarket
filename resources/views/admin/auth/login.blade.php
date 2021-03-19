@extends('admin.layouts.app_auth')
@section('title')
{{ __('login') }}
@endsection

@section('content')
<livewire:admin.auth.login />
@endsection