<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    	<div class="container-fluid">
      	<div class="row mb-2">
        		<div class="col-sm-6">
          		<h1 class="m-0">{{__('banks')}}</h1>
        		</div><!-- /.col -->
        		<div class="col-sm-6">
          		<ol class="breadcrumb float-sm-right">
            			<li class="breadcrumb-item"><a href="{{ route('home') }}">{{__('home')}}</a></li>
            			<li class="breadcrumb-item active">{{__('banks')}}</li>
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
        <i class="fa fa-plus"></i> {{__('bank')}}
      </button>
      <!-- show all banks start -->
      <div class="card">
          <div class="card-header">
            <h3 class="card-title">{{__('banks')}}</h3>
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
                   
              </tbody>
            </table>
          </div>
        <!-- /.card-body -->
      </div>
      <!-- show all banks end -->


      <!-- /.card -->
      </div>
  </section>
    <!-- /.content -->
</div>
@push('scripts')
  <script type="text/javascript">
    // hide modal after creating bank
    window.livewire.on('bank_created', () => {
      $('#add_bank_modal').modal('hide');  
        toastr.success('{{__("created")}}');
    });
    // show error message if not created
    window.livewire.on('bank_not_created', () => {
      toastr.error('{{__("not_created")}}');    
    });
    
    // hide modal after updating bank
    window.livewire.on('bank_updated', () => {
      $('#edit_bank_modal').modal('hide');
      toastr.success('{{__("updated")}}');
    });
    // show error message if not updated
    window.livewire.on('bank_not_updated', () => {
      toastr.error('{{__("not_updated")}}');    
    });
    // hide modal after deleting bank
    window.livewire.on('bank_deleted', () => {
      $('#delete_bank_modal').modal('hide');
      toastr.success('{{__("deleted")}}');
    });
    // show error message if not deleted
    window.livewire.on('bank_not_deleted', () => {
      toastr.error('{{__("not_deleted")}}');
    });
  </script>
@endpush

