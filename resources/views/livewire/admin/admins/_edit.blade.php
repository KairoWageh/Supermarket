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
                        <label for="current_image">{{__('current_image')}}</label>
                        <img src="{{ asset('storage/app/'.$current_image) }}" height="60" width="60" wire:model="current_image">
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