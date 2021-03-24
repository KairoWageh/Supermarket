<!-- Edit category modal start -->
<div wire:ignore.self class="modal fade" id="edit_category_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">{{__('edit')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form wire:submit.prevent="update({{$category_id}})">
                
                <div class="modal-body">
                    <div class="form-group">
                        <label for="ar_title">{{__('ar_title')}}</label>
                        <input type="text" class="form-control @error('ar_title') is-invalid @enderror" id="edit_ar_title" placeholder="{{__('ar_title')}}" wire:model="ar_title" name="ar_title">
                        @error('ar_title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="en_title">{{__('en_title')}}</label>
                        <input type="text" class="form-control @error('en_title') is-invalid @enderror" id="edit_en_title" placeholder="{{__('en_title')}}" wire:model="en_title" name="en_title"> 
                        @error('en_title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image">{{__('image')}}</label>
                        <input type="file" name="image" wire:model="image" class="form-control @error('image') is-invalid @enderror" id="edit_image{{ $iteration }}">
                        <label for="current_image">{{__('current_image')}}</label>
                        <img src="{{ asset('storage/app/'.$current_image) }}" height="60" width="60" wire:model="current_image">
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">{{__('description')}}</label>
                        <textarea name="description" wire:model="des" class="form-control @error('description') is-invalid @enderror" id="edit_description"></textarea>
                        @error('description')
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
<!-- Edit category modal end -->