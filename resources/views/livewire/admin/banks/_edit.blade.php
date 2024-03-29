<!-- Edit bank modal start -->
<div wire:ignore.self class="modal fade" id="edit_bank_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">{{__('edit')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form wire:submit.prevent="update({{$bank_id}})">
                
                <div class="modal-body">
                    <div class="form-group">
                        <label for="account_name">{{__('account_name')}}</label>
                        <input type="text" class="form-control @error('account_name') is-invalid @enderror" id="account_name" placeholder="{{__('account_name')}}" wire:model="account_name">
                        @error('account_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="account_number ">{{__('account_number ')}}</label>
                        <input type="text" name="account_number" wire:model="account_number" class="form-control @error('account_number') is-invalid @enderror" id="account_number" placeholder="{{__('account_number')}}"> 
                        @error('account_number')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="bank_name">{{__('bank_name')}}</label>
                        <input type="text" class="form-control @error('bank_name') is-invalid @enderror" id="bank_name" placeholder="{{__('bank_name')}}" wire:model="bank_name">
                        @error('bank_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="iban">{{__('iban')}}</label>
                        <input type="text" name="iban" wire:model="iban" class="form-control @error('iban') is-invalid @enderror" id="iban" placeholder="{{__('iban')}}">
                        @error('iban')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="image">{{__('image')}}</label>
                        <input type="file" name="image" wire:model="bank_image" class="form-control @error('image') is-invalid @enderror" id="upload{{ $iteration }}">
                        <label for="current_image">{{__('current_image')}}</label>
                        <img src="{{ asset('storage/app/'.$current_image) }}" height="60" width="60" wire:model="current_image">
                        @error('image')
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
<!-- Edit bank modal end -->