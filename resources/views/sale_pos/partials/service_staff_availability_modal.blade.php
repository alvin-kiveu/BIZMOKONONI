<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">@lang('lang_v1.service_staff_availability_status')</h4>
		</div>
		<div class="modal-body overlay-wrapper">
			<div class="row eq-height-row">
				@foreach($service_staffs as $service_staff)
					@php
	            		$is_available = true;

	            		if(!empty($service_staff->available_at) && \Carbon::parse($service_staff->available_at)->gt(\Carbon::now()) && empty($service_staff->paused_at)) {
	            			$is_available = false;
	            		}
	            	@endphp
					<div class="col-md-3 col-xs-6 eq-height-col">
						<div class="small-box @if($is_available && empty($service_staff->paused_at)) bg-green @elseif(!empty($service_staff->paused_at)) bg-gray @else  bg-yellow @endif width-100">
				            <div class="inner">
				            	<img src="{{$service_staff->image_url}}" alt="Profile photo" style="width: 100%;">
				            	<p class="text-center text-white">{{$service_staff->username}}</p>
				            	<h4 class="text-center text-white"><i class="fas fa-user"></i> {{$service_staff->user_full_name}}</h4>
				            	
				            	@if(!$is_available)
				            		<h4 class="text-center text-white">
				            			{{\Carbon::now()->diff(\Carbon::parse($service_staff->available_at))->format('%H:%I')}}
				            		</h4>
				            		<p class="text-center text-white">@lang('lang_v1.will_be_available_at') {{\Carbon::parse($service_staff->available_at)->format('H:i')}}</p>
				            	@elseif(!empty($service_staff->paused_at))
				            		<h4 class="text-center text-white"><i class="fa fa-pause-circle"></i> @lang('lang_v1.paused')</h4>
				            		@php
				            			$is_available = false;
				            		@endphp
				            	@else
				            		<h4 class="text-center text-white" style="margin-top: 35%;">@lang('lang_v1.available')</h4>
				            	@endif
				            </div>
				            @if(!$is_available)
				            <div @if(!empty($service_staff->paused_at)) style="position: absolute; bottom: 0;" @endif>
				            	<a class="btn btn-flat small-box-footer bg-light-blue mark_as_available width-100" href="{{action([\App\Http\Controllers\SellPosController::class, 'markAsAvailable'], [$service_staff->id])}}">@lang('lang_v1.mark_as_available') <i class="fa fa-arrow-circle-right"></i></a>

				            	@if(empty($service_staff->paused_at))
			            			<button type="button" class="btn btn-flat small-box-footer bg-red pause_resume_timer width-100" data-href="{{action([\App\Http\Controllers\SellPosController::class, 'pauseResumeServiceStaffTimer'], [$service_staff->id])}}">@lang('lang_v1.pause_timer') <i class="fa fa-pause-circle"></i></button>
			            		@else
			            			<button type="button" class="btn btn-flat small-box-footer bg-green pause_resume_timer width-100" data-href="{{action([\App\Http\Controllers\SellPosController::class, 'pauseResumeServiceStaffTimer'], [$service_staff->id])}}">@lang('lang_v1.resume_timer') <i class="fa fa-redo"></i></button>
			            		@endif
			            	</div>
				            @endif
				         </div>
					</div>
				@endforeach
			</div>
			<div class="overlay hide">
				<i class="fa fas fa-sync fa-spin"></i>
			</div>
		</div>

		<div class="modal-footer">
			<button type="button" id="refresh_service_staff_availability_status" title="@lang('lang_v1.refresh')" class="tw-dw-btn tw-dw-btn-success tw-text-white"><i class="fas fa-redo"></i> @lang('lang_v1.refresh')</button>

		    <button type="button" class="tw-dw-btn tw-dw-btn-neutral tw-text-white" data-dismiss="modal">@lang('messages.close')</button>
		</div>
	</div>
</div>