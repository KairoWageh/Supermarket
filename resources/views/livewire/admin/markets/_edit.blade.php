<!-- Edit market modal start -->
<div wire:ignore.self class="modal fade" id="edit_market_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">{{__('edit')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form wire:submit.prevent="update({{$market_id}})">
                
                <div class="modal-body">
                    <div class="form-group">
                        <label for="ar_title">{{__('ar_title')}}</label>
                        <input type="text" class="form-control @error('ar_title') is-invalid @enderror" id="ar_title" placeholder="{{__('ar_title')}}" wire:model="ar_title">
                        @error('ar_title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="en_title">{{__('en_title')}}</label>
                        <input type="text" name="en_title" wire:model="en_title" class="form-control @error('en_title') is-invalid @enderror" id="en_title" placeholder="{{__('en_title')}}">
                        @error('en_title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone_code">{{__('phone_code')}}</label>
                        <input type="text" class="form-control @error('phone_code') is-invalid @enderror" id="phone_code" placeholder="{{__('phone_code')}}" wire:model="phone_code">
                        @error('phone_code')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone">{{__('phone')}}</label>
                        <input type="text" name="phone" wire:model="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="{{__('phone')}}">
                        @error('phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image">{{__('image')}}</label>
                        <input type="file" name="image" wire:model="market_image" class="form-control @error('image') is-invalid @enderror" id="image{{ $iteration }}">
                        <label for="current_image">{{__('current_image')}}</label>
                        <img src="{{ asset('storage/app/'.$current_image) }}" height="60" width="60" wire:model="current_image">
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="banner">{{__('banner')}}</label>
                        <input type="file" name="banner" wire:model="banner" class="form-control @error('banner') is-invalid @enderror" id="banner{{ $iteration }}">
                        <label for="current_banner">{{__('current_banner')}}</label>
                        <img src="{{ asset('storage/app/'.$current_banner) }}" height="60" width="60" wire:model="current_banner">
                        @error('banner')
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
<!-- Edit market modal end -->