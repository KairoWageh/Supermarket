<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      	<div class="container-fluid">
        	<div class="row mb-2">
          		<div class="col-sm-6">
            		<h1 class="m-0">{{__('setings')}}</h1>
          		</div><!-- /.col -->
          		<div class="col-sm-6">
            		<ol class="breadcrumb float-sm-right">
              			<li class="breadcrumb-item"><a href="{{ route('home') }}">{{__('home')}}</a></li>
              			<li class="breadcrumb-item active">{{__('setings')}}</li>
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

        <!-- show all admins start -->
	        <div class="card">
	            <div class="card-header">
	              <h3 class="card-title">{{__('setings')}}</h3>
	            </div>
	            <!-- /.card-header -->
	            <div class="card-body">
	            	<div class="box">
						<div class="box-body">
							{!! Form::open(['url' => '', 'files' => true]) !!}
							<div class="form-group">
								{!! Form::label('ar_title', __('ar_title')) !!}
								{!! Form::text('ar_title', setting()->ar_title, ['class' => 'form-control']) !!}
							</div>
							<div class="form-group">
								{!! Form::label('en_title', __('en_title')) !!}
								{!! Form::text('en_title', setting()->en_title, ['class' => 'form-control']) !!}
							</div>
							<div class="form-group">
								{!! Form::label('email1', __('email')) !!}
								{!! Form::text('email1', setting()->email1, ['class' => 'form-control']) !!}
							</div>
							<div class="form-group">
								{!! Form::label('email2', __('email')) !!}
								{!! Form::text('email2', setting()->email2, ['class' => 'form-control']) !!}
							</div>
							<div class="form-group">
								{!! Form::label('address1', __('address')) !!}
								{!! Form::text('address1', setting()->address1, ['class' => 'form-control']) !!}
							</div>
							<div class="form-group">
								{!! Form::label('address2', __('address')) !!}
								{!! Form::text('address2', setting()->address2, ['class' => 'form-control']) !!}
							</div>
							<div class="form-group">
								{!! Form::label('phone1', __('phone')) !!}
								{!! Form::text('phone1', setting()->phone1, ['class' => 'form-control']) !!}
							</div>
							<div class="form-group">
								{!! Form::label('phone2', __('phone')) !!}
								{!! Form::text('phone2', setting()->phone2, ['class' => 'form-control']) !!}
							</div>

							<div class="form-group">
								{!! Form::label('default_language', __('default_language')) !!}
								{!! Form::select('default_language', ['en' => 'English', 'ar' => 'العربية'], setting()->default_language, ['class' => 'form-control']) !!}
							</div>

							{!! Form::submit(__('save'), ['class' => 'btn btn-primary']) !!}
							{!! Form::close() !!}
						</div>
					</div>
	            </div>
	          <!-- /.card-body -->
	        </div>

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
    window.livewire.on('category_updated', () => {
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

