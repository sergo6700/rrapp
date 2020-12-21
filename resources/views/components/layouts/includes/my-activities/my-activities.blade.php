<div class="swiper-slide my-activities-slide">
	<div class="toggle-activities-buttons">
		<button class="button button_rounded button_small button_grey-border-tr button_toggle-activities">
		    <span class="text text_17 text_bold text_black text_PT-font">Прошедшие мероприятия</span>
    	</button>
	</div>
	<div class="my-activities-current">

		@foreach($data ?? [] as $date => $events)
			@foreach($events as $event)
				@if(!($event->passed ?? null))
					@if($loop->first)
						@include('components.layouts.sections.activities-card-with-date', ['cancel_button' => true])
					@else
						@include('components.layouts.sections.activities-card-no-date', ['cancel_button' => true])
					@endif
				@endif
			@endforeach
		@endforeach

	</div>
	<div class="my-activities-past">

		@foreach($data ?? [] as $date => $events)
			@foreach($events as $event)
				@if($event->passed ?? null)
					@if($loop->first)
						@include('components.layouts.sections.activities-card-past-activity')
					@else
						@include('components.layouts.sections.activities-card-no-date')
					@endif
				@endif
			@endforeach
		@endforeach

	</div>
</div>
