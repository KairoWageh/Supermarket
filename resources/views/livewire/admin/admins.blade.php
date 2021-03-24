<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    	<div class="container-fluid">
      	<div class="row mb-2">
        		<div class="col-sm-6">
          		<h1 class="m-0">{{__('admins')}}</h1>
        		</div><!-- /.col -->
        		<div class="col-sm-6">
          		<ol class="breadcrumb float-sm-right">
            			<li class="breadcrumb-item"><a href="{{ route('home') }}">{{__('home')}}</a></li>
            			<li class="breadcrumb-item active">{{__('admins')}}</li>
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

  		<button type="button" class="btn btn-primary add_btn" data-toggle="modal" data-target="#add_admin_modal" wire:click="create">
        <i class="fa fa-plus"></i> {{__('admin')}}
      </button>
      <!-- show all admins start -->
      <div class="card">
          <div class="card-header">
            <h3 class="card-title">{{__('admins')}}</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="admins_table" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>{{__('name')}}</th>
                  <th>{{__('email')}}</th>
                  <th>{{__('image')}}</th>
                  <th>{{__('actions')}}</th>
                </tr>
              </thead>
              <tbody>
                @foreach($admins as $admin)
                  <tr>
                    <td>{{$admin->id}}</td>
                    <td>{{$admin->name}}</td>
                    <td>{{$admin->email}}</td>
                    <td>
                      <img src="{{ asset('storage/app/'.$admin->image) }}" height="60" width="60" />
                    </td>
                    <td>
                      <p>{{$admin->id}}</p>
                        <button type="button" wire:click="edit({{$admin->id}})" class="btn btn-info" data-toggle="modal"  data-target="#edit_admin_modal">
                            <i class="fa fa-edit"></i> 
                          </button>

                          <button type="button" wire:click="delete({{$admin->id}})" class="btn btn-danger" data-toggle="modal"  data-target="#delete_admin_modal">
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
      <!-- show all admins end -->

      @include('livewire.admin.admins._edit')
      @if(isset($admin))
        @include('livewire.admin.admins._delete')
      @endif
      @include('livewire.admin.admins._create')


      <!-- /.card -->
      </div>
  </section>
    <!-- /.content -->
</div>
@push('scripts')
  <script type="text/javascript">
    // hide modal after creating admin
    window.livewire.on('admin_created', () => {
      $('#add_admin_modal').modal('hide');  
        toastr.success('{{__("created")}}');
    });
    // show error message if not created
    window.livewire.on('admin_not_created', () => {
      toastr.error('{{__("not_created")}}');    
    });
    
    // hide modal after updating admin
    window.livewire.on('admin_updated', () => {
      $('#edit_admin_modal').modal('hide');
      toastr.success('{{__("updated")}}');
    });
    // show error message if not updated
    window.livewire.on('admin_not_updated', () => {
      toastr.error('{{__("not_updated")}}');    
    });
    // hide modal after deleting admin
    window.livewire.on('admin_deleted', () => {
      $('#delete_admin_modal').modal('hide');
      toastr.success('{{__("deleted")}}');
    });
    // show error message if not deleted
    window.livewire.on('admin_not_deleted', () => {
      toastr.error('{{__("not_deleted")}}');
    });
  </script>
@endpush

