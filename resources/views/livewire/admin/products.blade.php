<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      	<div class="container-fluid">
        	<div class="row mb-2">
          		<div class="col-sm-6">
            		<h1 class="m-0">{{__('products')}}</h1>
          		</div><!-- /.col -->
          		<div class="col-sm-6">
            		<ol class="breadcrumb float-sm-right">
              			<li class="breadcrumb-item"><a href="{{ route('home') }}">{{__('home')}}</a></li>
              			<li class="breadcrumb-item active">{{__('products')}}</li>
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

    		<button type="button" class="btn btn-primary add_btn" data-toggle="modal" data-target="#add_product_modal" wire:click="create">
          <i class="fa fa-plus"></i> {{__('product')}}
        </button>
        <!-- show all admins start -->
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">{{__('products')}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="categories_table" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>{{__('title')}}</th>
                    <th>{{__('description')}}</th>
                    <th>{{__('image')}}</th>
                    
                    <th>{{__('actions')}}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($products as $product)
                    <tr>
                      <td>{{$product->id}}</td>
                      <td>{{$product->product_title}}</td>
                      <td>{{ \Illuminate\Support\Str::limit($product->product_description, $limit = 30, $end = '...') }}</td>
                      <td>
                        <img src="{{ asset('storage/app/'.$product->image) }}" height="60" width="60" />
                      </td>
                      <td>
                        <button type="button" class="btn btn-info" data-toggle="modal" wire:click=" edit({{ $product->id }})" data-target="#edit_product_modal">
                          <i class="fa fa-edit"></i>
                        </button>
                        <button type="button" class="btn btn-danger" data-toggle="modal" wire:click=" delete({{ $product->id }})" data-target="#delete_product_modal">
                          <i class="fa fa-trash"></i>
                        </button>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          <!-- /.card-body -->
        </div>
        <!-- show all categories end -->
        @include('livewire.admin.products._create')
        @include('livewire.admin.products._edit')
        @if(isset($product))
          @include('livewire.admin.products._delete')
        @endif
        <!--  -->
        <!-- /.card -->
        </div>
    </section>
    <!-- /.content -->
</div>
@push('scripts')
  <script type="text/javascript">
    // hide modal after creating product
    window.livewire.on('product_created', () => {
      $('#add_product_modal').modal('hide');  
        toastr.success('{{__("created")}}');
    });
    // show error message if not created
    window.livewire.on('product_not_created', () => {
      toastr.error('{{__("not_created")}}');    
    });
    
    // hide modal after updating product
    window.livewire.on('product_updated', () => {
      $('#edit_product_modal').modal('hide');
      toastr.success('{{__("updated")}}');
    });
    // show error message if not updated
    window.livewire.on('product_not_updated', () => {
      toastr.error('{{__("not_updated")}}');    
    });
    // hide modal after deleting product
    window.livewire.on('product_deleted', () => {
      $('#delete_product_modal').modal('hide');
      toastr.success('{{__("deleted")}}');
    });
    // show error message if not deleted
    window.livewire.on('product_not_deleted', () => {
      toastr.error('{{__("not_deleted")}}');
    });
  </script>
@endpush

