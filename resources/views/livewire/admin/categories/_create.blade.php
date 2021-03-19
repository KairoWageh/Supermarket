<!--add category modal start -->
<div wire:ignore.self class="modal fade" id="add_category_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <label for="image">{{__('image')}}</label>
                        <input type="file" name="image" wire:model="image" class="form-control @error('image') is-invalid @enderror" id="image{{ $iteration }}">
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">{{__('description')}}</label>
                        <textarea name="description" wire:model="description" class="form-control @error('description') is-invalid @enderror" id="description"></textarea>
                        @error('description')
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
<!-- add category modal end -->
</div>