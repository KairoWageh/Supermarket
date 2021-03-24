<!-- Edit admin modal start -->
<div wire:ignore.self class="modal fade" id="edit_admin_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">{{__('edit')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form wire:submit.prevent="update({{$admin_id}})">
                
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_name">{{__('name')}}</label>
                        <input type="text" class="form-control @error('edit_name') is-invalid @enderror" id="edit_name" placeholder="{{__('edit_name')}}" wire:model="name">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="edit_email">{{__('email')}}</label>
                        <input type="email" name="edit_email" wire:model="email" class="form-control @error('edit_email') is-invalid @enderror" id="edit_email" placeholder="{{__('email')}}">
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="admin_image">{{__('image')}}</label>
                        <input type="file" name="admin_image" wire:model="admin_image" class="form-control @error('admin_image') is-invalid @enderror" id="edit_image{{ $iteration }}">
                        <label for="edit_current_image">{{__('current_image')}}</label>
                        <img src="{{ asset('storage/app/'.$current_image) }}" height="60" width="60" wire:model="current_image" name="edit_current_image">
                        @error('admin_image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="edit_password">{{__('password')}}</label>
                        <input type="password" name="edit_password" wire:model="password" class="form-control @error('edit_password') is-invalid @enderror" id="edit_password">
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>                    
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{__('cancel')}}</button>
                    <button type="submit" class="btn btn-primary">{{__('edit')}}</button>
                </div>
            </form>
        </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Edit admin modal end -->