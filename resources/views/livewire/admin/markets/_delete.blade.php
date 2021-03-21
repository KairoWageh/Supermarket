<!-- Delete market modal start -->
<div wire:ignore.self id="delete_market_modal" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header flex-column">					
				<h4 class="modal-title w-100">{{__('are_you_sure')}}</h4>	
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<p>{{__('confirm')}}</p>

			</div>
			<div class="modal-footer justify-content-center">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('cancel')}}</button>
				@if(isset($selected_market))
				<button type="button" class="btn btn-danger" wire:click="delete_confirm({{$selected_market['id']}})">{{__('delete')}}</button>
				@endif
			</div>
		</div>
	</div>
</div> 
<!-- Delete market modal end -->