<!--add admin modal start -->
<div wire:ignore.self class="modal fade" id="add_admin_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    	<div class="modal-content">
            <div class="modal-header bg-primary">
            	<h4 class="modal-title">{{__('add')}}</h4>
              	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                	<span aria-hidden="true">&times;</span>
              	</button>
            </div>
            <div class="validation-errors">
            </div>
            <form wire:submit.prevent="store">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">{{__('name')}}</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="{{__('name')}}" wire:model="name">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">{{__('email')}}</label>
                        <input type="email" name="email" wire:model="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="{{__('email')}}">
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image">{{__('image')}}</label>
                        <input type="file" name="image" wire:model="admin_image" class="form-control @error('image') is-invalid @enderror" id="image{{ $iteration }}">
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">{{__('password')}}</label>
                        <input type="password" name="password" wire:model="password" class="form-control @error('password') is-invalid @enderror" id="password">
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">{{__('password_confirmation')}}</label>
                        <input type="password" name="password_confirmation" wire:model="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" placeholder="{{__('password_confirmation')}}">
                        @error('password_confirmation')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{__('cancel')}}</button>
                    <button type="submit" class="btn btn-primary">{{__('add')}}</button>
                </div>
            </div>
            </form>
      <!-- /.modal-content -->
        </div>
    <!-- /.modal-dialog -->
    </div>
<!-- add admin modal end -->
</div>