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
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>{{ $user_count }}</h3>

                <p>{{__('users')}}</p>
              </div>
              <div class="icon">
                <i class="nav-icon fa fa-users"></i>
              </div>
              <a href="" class="small-box-footer">{{__('more')}} <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $admin_count }}</h3>

                <p>{{__('admins')}}</p>
              </div>
              <div class="icon">
                <i class="nav-icon fa fa-user-tie"></i>
              </div>
              <a href="" class="small-box-footer">{{__('more')}} <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->


        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
	        <!-- Left col -->
	        <section class="col-lg-6 connectedSortable">
	        	<!-- Map card -->
	            <div class="card bg-gradient-primary">
	              <div class="card-header border-0">
	                <h3 class="card-title">
	                  <i class="fas fa-map-marker-alt mr-1"></i>
	                  Visitors
	                </h3>
	                <!-- card tools -->
	                <div class="card-tools">
	                  <button type="button" class="btn btn-primary btn-sm daterange" title="Date range">
	                    <i class="far fa-calendar-alt"></i>
	                  </button>
	                  <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
	                    <i class="fas fa-minus"></i>
	                  </button>
	                </div>
	                <!-- /.card-tools -->
	              </div>
	              <div class="card-body">
	                <div id="world-map" style="height: 250px; width: 100%;"></div>
	              </div>
	              <!-- /.card-body-->
	              <div class="card-footer bg-transparent">
	                <div class="row">
	                  <div class="col-4 text-center">
	                    <div id="sparkline-1"></div>
	                    <div class="text-white">Visitors</div>
	                  </div>
	                  <!-- ./col -->
	                  <div class="col-4 text-center">
	                    <div id="sparkline-2"></div>
	                    <div class="text-white">Online</div>
	                  </div>
	                  <!-- ./col -->
	                  <div class="col-4 text-center">
	                    <div id="sparkline-3"></div>
	                    <div class="text-white">Sales</div>
	                  </div>
	                  <!-- ./col -->
	                </div>
	                <!-- /.row -->
	              </div>
	            </div>
            <!-- /.card -->
	        </section>
          	<!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-6 connectedSortable">

            <!-- Calendar -->
            <div class="card bg-gradient-success">
              <div class="card-header border-0">

                <h3 class="card-title">
                  <i class="far fa-calendar-alt"></i>
                  Calendar
                </h3>
                <!-- tools card -->
                <div class="card-tools">
                  <!-- button with a dropdown -->
                  <div class="btn-group">
                    <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                      <i class="fas fa-bars"></i>
                    </button>
                    <div class="dropdown-menu" role="menu">
                      <a href="#" class="dropdown-item">Add new event</a>
                      <a href="#" class="dropdown-item">Clear events</a>
                      <div class="dropdown-divider"></div>
                      <a href="#" class="dropdown-item">View calendar</a>
                    </div>
                  </div>
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /. tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body pt-0">
                <!--The calendar -->
                <div id="calendar" style="width: 100%"></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection