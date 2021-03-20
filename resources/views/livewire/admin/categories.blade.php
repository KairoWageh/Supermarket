<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      	<div class="container-fluid">
        	<div class="row mb-2">
          		<div class="col-sm-6">
            		<h1 class="m-0">{{__('categories')}}</h1>
          		</div><!-- /.col -->
          		<div class="col-sm-6">
            		<ol class="breadcrumb float-sm-right">
              			<li class="breadcrumb-item"><a href="{{ route('home') }}">{{__('home')}}</a></li>
              			<li class="breadcrumb-item active">{{__('categories')}}</li>
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

    		<button type="button" class="btn btn-primary add_btn" data-toggle="modal" data-target="#add_category_modal" wire:click="create">
          <i class="fa fa-plus"></i> {{__('category')}}
        </button>
        <!-- show all admins start -->
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">{{__('categories')}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="categories_table" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>{{__('title')}}</th>
                    <th>{{__('image')}}</th>
                    <th>{{__('description')}}</th>
                    <th>{{__('actions')}}</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                      <td>{{ $category->id }}</td>
                      <td>{{ $category->category_title }}</td>
                      <td>
                        <img src="{{ asset('storage/'.$category->image) }}" height="60" width="60" />
                      </td>
                      <td>{{ \Illuminate\Support\Str::limit($category->des, $limit = 30, $end = '...') }}</td>
                      <td>
                        <button type="button" class="btn btn-info" data-toggle="modal" wire:click=" edit({{ $category->id }})" data-target="#edit_category_modal">
                          <i class="fa fa-edit"></i>
                        </button>
                        <button type="button" class="btn btn-danger" data-toggle="modal" wire:click=" delete({{ $category->id }})" data-target="#delete_category_modal">
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
        @include('livewire.admin.categories._create')
        @include('livewire.admin.categories._edit')
        @if(isset($category))
          @include('livewire.admin.categories._delete')
        
        @endif
        <!-- /.card -->
        </div>
    </section>
    <!-- /.content -->
</div>
@push('scripts')
  <script type="text/javascript">
    // hide modal after creating category
    window.livewire.on('category_created', () => {
      $('#add_category_modal').modal('hide');  
        toastr.success('{{__("created")}}');
    });
    // show error message if not created
    window.livewire.on('category_not_created', () => {
      toastr.error('{{__("not_created")}}');    
    });
    
    // hide modal after updating category
    window.livewire.on('category_updated', () => {
      $('#edit_category_modal').modal('hide');
      toastr.success('{{__("updated")}}');
    });
    // show error message if not updated
    window.livewire.on('category_not_updated', () => {
      toastr.error('{{__("not_updated")}}');    
    });
    // hide modal after deleting category
    window.livewire.on('category_has_products', () => {
      $('#delete_category_modal').modal('hide');
      toastr.warning('{{__("has_products")}}');
    });
    // hide modal after deleting category
    window.livewire.on('category_deleted', () => {
      $('#delete_category_modal').modal('hide');
      toastr.success('{{__("deleted")}}');
    });
    // show error message if not deleted
    window.livewire.on('category_not_deleted', () => {
      toastr.error('{{__("not_deleted")}}');
    });
  </script>
@endpush

