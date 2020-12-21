@extends('layouts.extend')

@section('title', $title)
@section('description', $description)
@section('breadcrumbs', Breadcrumbs::render('events'))

@section('content.child')
	<div class="section-content">
		<div class="container container_small">
			@include('components.layouts.sections.title-with-filter')

			@foreach($data as $date => $events)
				<div class="activities-card-container">

					@foreach($events as $event)

						@if($loop->first)

							@if($event->passed ?? null)
								@include('components.layouts.sections.activities-card-past-activity')
							@else
								@include('components.layouts.sections.activities-card-with-date')
							@endif

						@else
							@include('components.layouts.sections.activities-card-no-date')
						@endif

					@endforeach

				</div>
			@endforeach
		</div> <!-- /.container -->
	</div> <!-- /.section-content -->

	@push('popup')
		@include('components.layouts.sections.popup', ['title' => $title])
	@endpush

@endsection