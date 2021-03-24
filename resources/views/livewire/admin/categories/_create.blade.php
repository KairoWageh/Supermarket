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
                        <label for="type">{{__('type')}}</label>
                        <select wire:model="type" class="form-control @error('type') is-invalid @enderror">
                            <option value="">....</option>
                            <option value="private" wire:key="private">{{__('private')}}</option>
                            <option value="public" wire:key="public">{{__('public')}}</option>
                        </select>
                        @error('type')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    @if (!is_null($type) &&  $type == 'private')
                        @if(isset($markets) &&  $markets_count > 0)
                            <div class="form-group row">
                                <label for="market" class="col-md-4 col-form-label text-md-right">{{__('market')}}</label>
                                <div class="col-md-6">
                                    <select class="form-control" wire:model="market">
                                       <option value="" selected>{{__('choose_market')}}</option>

                                        @foreach($markets as $market)
                                            <option value="{{ $market->id }}" wire:key="market_id">{{ $market->market_title }}</option>
                                        @endforeach
     
                                    </select>

                                </div>
                            </div>
                        @else
                            <div class="form-group row">
                               <p>{{__('no_markets')}}</p> 
                            </div>
                        @endif
                         @error('market_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    @endif
                    <div class="form-group">
                        <label for="level">{{__('level')}}</label>
                        <select wire:model="level" class="form-control @error('level') is-invalid @enderror">
                            <option value="">....</option>
                            <option value="main_category" wire:key="main_category">{{__('main_category')}}</option>
                            <option value="sub_category" wire:key="sub_category">{{__('sub_category')}}</option>
                        </select>
                        @error('level')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    @if (!is_null($level) &&  $level == 'sub_category')
                        @if(isset($categories) &&  $categories_count > 0)
                            <div class="form-group row">
                                <label for="category" class="col-md-4 col-form-label text-md-right">{{__('main_category')}}</label>
                                <div class="col-md-6">
                                    <select class="form-control" wire:model="category" >
                                       <option value="" selected>{{__('choose_main_category')}}</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" wire:key="category_id">{{ $category->category_title }}</option>
                                        @endforeach
                                    </select>
                                    
                                </div>
                            </div>
                        @else
                            <div class="form-group row">
                               <p>{{__('no_categories')}}</p> 
                            </div>
                        @endif
                        @error('category')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    @endif
                    <div class="form-group">
                        <label for="des">{{__('description')}}</label>
                        <textarea name="des" wire:model="des" class="form-control @error('des') is-invalid @enderror" id="des"></textarea>
                        @error('des')
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