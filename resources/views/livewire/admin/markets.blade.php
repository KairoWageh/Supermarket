<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      	<div class="row mb-2">
        	<div class="col-sm-6">
          		<h1 class="m-0">{{__('markets')}}</h1>
        	</div><!-- /.col -->
        	<div class="col-sm-6">
          		<ol class="breadcrumb float-sm-right">
        			<li class="breadcrumb-item"><a href="{{ route('home') }}">{{__('home')}}</a></li>
        			<li class="breadcrumb-item active">{{__('markets')}}</li>
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

  		<button type="button" class="btn btn-primary add_btn" data-toggle="modal" data-target="#add_market_modal" wire:click="create">
        <i class="fa fa-plus"></i> {{__('market')}}
      </button>
      <!-- show all markets start -->
      <div class="card">
          <div class="card-header">
            <h3 class="card-title">{{__('markets')}}</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            @if($markets_count > 0)
              <table id="markets_table" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>{{__('title')}}</th>
                    <th>{{__('phone')}}</th>
                    <th>{{__('email')}}</th>
                    <th>{{__('image')}}</th>
                    <th>{{__('actions')}}</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($markets as $market) 
                    	<tr>
                    		<td>{{$market->id}}</td>
                    		<td>{{$market->market_title}}</td>
                    		<td>{{$market->phone_code}} {{$market->phone}}</td>
                    		<td>{{$market->email}}</td>
                    		<td>
                          	<img src="{{ asset('storage/app/'.$market->image) }}" height="60" width="60" />
                        </td>
                        <td>
                          <button type="button" class="btn btn-info" data-toggle="modal" wire:click=" edit({{ $market->id }})" data-target="#edit_market_modal">
                            <i class="fa fa-edit"></i>
                          </button>
                          <button type="button" class="btn btn-danger" data-toggle="modal" wire:click=" delete({{ $market->id }})" data-target="#delete_market_modal">
                            <i class="fa fa-trash"></i>
                          </button>
                        </td>
                    	</tr>
                    @endforeach
                </tbody>
              </table>
            @else
              <p id="no_records_found">{{__('no_records_found')}}</p>
            @endif
          </div>
        <!-- /.card-body -->
      </div>
      <!-- show all markets end -->
      @include('livewire.admin.markets._create')
      @include('livewire.admin.markets._edit')
      @if(isset($market))
          @include('livewire.admin.markets._delete')
        @endif

      <!-- /.card -->
      </div>
  </section>
    <!-- /.content -->
</div>
@push('scripts')
  <script type="text/javascript">
    // hide modal after creating market
    window.livewire.on('market_created', () => {
      $('#add_market_modal').modal('hide');  
        toastr.success('{{__("created")}}');
    });
    // show error message if not created
    window.livewire.on('market_not_created', () => {
      toastr.error('{{__("not_created")}}');    
    });
    
    // hide modal after updating market
    window.livewire.on('market_updated', () => {
      $('#edit_market_modal').modal('hide');
      toastr.success('{{__("updated")}}');
    });
    // show error message if not updated
    window.livewire.on('market_not_updated', () => {
      toastr.error('{{__("not_updated")}}');    
    });
    // hide modal after deleting market
    window.livewire.on('market_deleted', () => {
      $('#delete_market_modal').modal('hide');
      toastr.success('{{__("deleted")}}');
    });
    // show error message if not deleted
    window.livewire.on('market_not_deleted', () => {
      toastr.error('{{__("not_deleted")}}');
    });
  </script>
@endpush

