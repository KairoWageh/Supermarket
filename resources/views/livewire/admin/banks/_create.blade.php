<!--add bank modal start -->
<div wire:ignore.self class="modal fade" id="add_bank_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <label for="ar_title">{{__('name')}}</label>
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
                        <label for="ar_description ">{{__('ar_description ')}}</label>
                        <textarea name="ar_description" wire:model="ar_description"class="form-control @error('ar_description ') is-invalid @enderror" id="ar_description " placeholder="{{__('ar_description ')}}" ></textarea> 
                        @error('ar_description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="en_description">{{__('en_description')}}</label>
                        <textarea name="en_description" wire:model="en_description" class="form-control @error('en_description') is-invalid @enderror" id="en_description" placeholder="{{__('en_description')}}"></textarea>
                        @error('en_description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image">{{__('image')}}</label>
                        <input type="file" name="image" wire:model="product_image" class="form-control @error('image') is-invalid @enderror" id="upload{{ $iteration }}">
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="price">{{__('price')}}</label>
                        <input type="number" name="price" wire:model="price" class="form-control @error('price') is-invalid @enderror" id="price" />
                        @error('price')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="quntity">{{__('quntity')}}</label>
                        <input type="number" name="quntity" wire:model="quntity" class="form-control @error('quntity') is-invalid @enderror" id="quntity" />
                        @error('quntity')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <select class="form-control" wire:model="category_id">
                            @foreach($categories as $category)
                                <option value="$category->id">{{ $category->category_title }}</option>
                            @endforeach
                        </select>
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
<!-- add bank modal end -->
</div>