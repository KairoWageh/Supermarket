<!-- Edit settings modal start -->
<div wire:ignore.self class="modal fade" id="edit_settings_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">{{__('edit')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form wire:submit.prevent="update({{$settings_id}})">
                      <div class="modal-body">
                        <div class="form-group">
                          <label for="ar_title">{{__('ar_title')}}</label>
                          <input type="text" value="{{setting()->ar_title}}" class="form-control @error('ar_title') is-invalid @enderror" id="ar_title" placeholder="{{__('ar_title')}}" wire:model="ar_title">
                          @error('ar_title')
                              <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                        </div>
                        <div class="form-group">
                          <label for="en_title">{{__('en_title')}}</label>
                          <input type="text" value="{{setting()->en_title}}" class="form-control @error('en_title') is-invalid @enderror" id="en_title" placeholder="{{__('en_title')}}" wire:model="en_title">
                          @error('en_title')
                              <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                        </div>
                        <div class="form-group">
                          <label for="ar_description ">{{__('ar_description ')}}</label>
                          <textarea name="ar_description" wire:model="ar_description" class="form-control @error('ar_description ') is-invalid @enderror" id="ar_description " placeholder="{{__('ar_description ')}}" ></textarea> 
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
                          <label for="logo">{{__('logo')}}</label>
                          <input type="file" name="logo" wire:model="logo" class="form-control @error('logo') is-invalid @enderror" id="upload{{ $iteration }}">
                          @error('logo')
                              <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                        </div>
                        <div class="form-group">
                            <label for="email1">{{__('email1')}}</label>
                            <input type="email" value="{{setting()->email1}}" class="form-control @error('email1') is-invalid @enderror" id="email1" placeholder="{{__('email1')}}" wire:model="email1">
                            @error('email1')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email2">{{__('email2')}}</label>
                            <input type="email" value="{{setting()->email2}}" class="form-control @error('email2') is-invalid @enderror" id="email2" placeholder="{{__('email2')}}" wire:model="email2">
                            @error('email2')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="address1">{{__('address1')}}</label>
                            <input type="text" value="{{setting()->address1}}" class="form-control @error('address1') is-invalid @enderror" id="address1" placeholder="{{__('address1')}}" wire:model="address1">
                            @error('address1')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address2">{{__('address2')}}</label>
                            <input type="text" value="{{setting()->address2}}" class="form-control @error('address2') is-invalid @enderror" id="address2" placeholder="{{__('address2')}}" wire:model="address2">
                            @error('address2')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone1">{{__('phone1')}}</label>
                            <input type="text" value="{{setting()->phone1}}" class="form-control @error('phone1') is-invalid @enderror" id="phone1" placeholder="{{__('phone1')}}" wire:model="phone1">
                            @error('phone1')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone2">{{__('phone2')}}</label>
                            <input type="text" value="{{setting()->phone2}}" class="form-control @error('phone2') is-invalid @enderror" id="phone2" placeholder="{{__('phone2')}}" wire:model="phone2">
                            @error('phone2')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                          <label for="default_language">{{__('default_language')}}</label>
                          <select class="form-control" name="default_language" id="default_language" wire:model="default_language">
                            <option wire:key="en" value="en" {{ setting()->default_language === 'en' ? 'selected' : '' }}>English</option>
                            <option wire:key="ar" value="ar" {{ setting()->default_language === 'ar' ? 'selected' : '' }}>العربية</option>
                          </select>
                        </div>
                      </div>
                      <div class="modal-footer justify-content-between">
                        <button type="submit" class="btn btn-primary">{{__('save')}}</button>
                      </div>
                    </form>
                  <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Edit settings modal end -->