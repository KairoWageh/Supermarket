@extends('admin.layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{__('dashboard')}}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="">{{__('home')}}</a></li>
              <li class="breadcrumb-item active">{{ __('dashboard') }}</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $user_count }}</h3>

                <p>{{__('users')}}</p>
              </div>
              <div class="icon">
                <i class="nav-icon fa fa-users"></i>
              </div>
              <a href="users" class="small-box-footer">{{__('more')}} <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $admin_count }}</h3>

                <p>{{__('admins')}}</p>
              </div>
              <div class="icon">
                <i class="nav-icon fa fa-user-tie"></i>
              </div>
              <a href="admins" class="small-box-footer">{{__('more')}} <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <div class="col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ $market_count }}</h3>

                <p>{{__('markets')}}</p>
              </div>
              <div class="icon">
                <i class="nav-icon fa fa-building"></i>
              </div>
              <a href="markets" class="small-box-footer">{{__('more')}} <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $order_count }}</h3>

                <p>{{__('orders')}}</p>
              </div>
              <div class="icon">
                <i class="inav-icon fa fa-shopping-cart"></i>
              </div>
              <a href="orders" class="small-box-footer">{{__('more')}} <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection