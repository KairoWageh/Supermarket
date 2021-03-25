<div wire:ignore.self class="content-wrapper">
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
                <button type="button" class="btn btn-info" data-toggle="modal" wire:click=" edit({{$settings_id}})" data-target="#edit_settings_modal">
                  <i class="fa fa-edit"></i>
                </button>
	            </div>
	            <!-- /.card-header -->
	            <div class="card-body">
	            	<div class="box">
						      <div class="box-body">
                      <div class="modal-body">
                        <div class="form-group">

                          
                          <label for="ar_title">{{__('ar_title')}}</label>
                          <span name="ar_title">{{setting()->ar_title}}</span>
                        </div>
                        <div class="form-group">
                          <label for="en_title">{{__('en_title')}}</label>
                          <span name="en_title">{{setting()->en_title}}</span>
                        </div>
                        <div class="form-group">
                          <label for="ar_description ">{{__('ar_description')}}</label>
                          <p name="ar_description">{{setting()->ar_des}}</p>
                        </div>
                        <div class="form-group">
                            <label for="en_description">{{__('en_description')}}</label>
                            <p name="en_description">{{setting()->en_des}}</p>
                        </div>
                        <div class="form-group">
                          <label for="logo">{{__('logo')}}</label>
                          <img src="storage/app/{{setting()->logo}}" width="60" height="60">
                        </div>
                        <div class="form-group">
                            <label for="email1">{{__('first_email')}}</label>
                            <span>{{setting()->email1}}</span>
                        </div>
                        <div class="form-group">
                            <label for="email2">{{__('second_email')}}</label>
                            <span>{{setting()->email2}}</span>
                        </div>


                        <div class="form-group">
                            <label for="address1">{{__('first_address')}}</label>
                            <span>{{setting()->address1}}</span>
                        </div>
                        <div class="form-group">
                            <label for="address2">{{__('second_address')}}</label>
                            <span>{{setting()->address2}}</span>
                        </div>

                        <div class="form-group">
                            <label for="phone1">{{__('first_phone')}}</label>
                            <span>{{setting()->phone1}}</span>
                        </div>
                        <div class="form-group">
                            <label for="phone2">{{__('second_phone')}}</label>
                            <span>{{setting()->phone1}}</span>
                        </div>
                        <div class="form-group">
                          <label for="default_language">{{__('default_language')}}</label>
                          <span>{{$language}}</span>
                        </div>
                      </div>
                  </div>
	          <!-- /.card-body -->
                </div>
              </div>
        <!--  -->
        </div>
        <!-- /.card -->
         @include('livewire.admin.settings._edit')
      </div>
    </section>
    <!-- /.content -->
</div>
@push('scripts')
  <script type="text/javascript">
    // hide modal after editing settings
    window.livewire.on('settings_updated', () => {
      $('#edit_settings_modal').modal('hide');
        toastr.success('{{__("updated")}}');
    });
    // show error message if not edited
    window.livewire.on('settings_not_updated', () => {
      toastr.error('{{__("not_updated")}}');    
    });
  </script>
@endpush

