<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('public/design/admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('public/design/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('public/design/admin/dist/css/adminlte.min.css') }}">
    @if(direction() == 'rtl')
        <link rel="stylesheet" href="{{asset('public/design/admin/plugins/bootstrap/css/bootstrap-rtl.css') }}">
        <link rel="stylesheet" href="{{asset('public/design/admin/docs/assets/css/style-ar.css') }}">
    @endif
    @livewireStyles
  </head>
  <body class="hold-transition login-page">
    <!-- Language -->
    <ul class='nav'>
      <li>
        <div class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{__('language')}}</a>
          <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">            
            <li>
              <a href="{{ url('locale/en') }}"> English </a>
            </li>
            <li>
              <a href="{{ url('locale/ar') }}"> العربية</a>
            </li>
          </ul>
        </div>   
        </li>
    </ul>
    @yield('content')
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('public/design/admin/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('public/design/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('public/design/admin/dist/js/adminlte.min.js') }}"></script>
    @livewireScripts
  </body>
</html>
