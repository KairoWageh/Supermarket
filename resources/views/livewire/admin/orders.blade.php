<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">{{__('orders')}}</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{__('home')}}</a></li>
                    <li class="breadcrumb-item active">{{__('orders')}}</li>
                </ol>
              </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- /.card -->

        
        <!-- show all orders start -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">{{__('orders')}}</h3>
            </div>
              <!-- /.card-header -->
            <div class="card-body">
              <table id="orders_table" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>{{__('product')}}</th>
                    <th>{{__('amount')}}</th>
                    <th>{{__('seller')}}</th>
                    <th>{{__('buyer')}}</th>
                    <th>{{__('actions')}}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($orders as $order)
                    <tr>
                      <td>{{$order->id}}</td>
                      <td>{{$order->product['product_title']}}</td>
                      <td>{{$order->amount}}</td>
                      <td>{{$order->seller['market_title']}}</td>
                      <td>{{$order->buyer->name}}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
        <!-- show all orders end -->
            <!-- /.card -->
            @include('livewire.admin.orders._show_order')
        </div>
    </section>
    <!-- /.content -->
</div>