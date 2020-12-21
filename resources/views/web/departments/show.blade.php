@extends('layouts.extend')

@section('title', $department->name)
@section('description', \App\Support\Seo\SeoUtils::prepareDescription($department->content))
@section('breadcrumbs', Breadcrumbs::render('departments.show', $department))

@section('content.child')
	<div class="section-content">
		<div class="container container_small">
			@include('components.layouts.sections.title-with-single-button', ['title' => $department->name])

			<div class="template-text-container">
				{!! $department->content !!}
			</div>

			<div class="section-title-small">
				<h3 class="h3">Меры поддержки</h3>
			</div>
			<div class="services-container">
				@each('components.layouts.includes.services-card-with-tag', $department->services ?? [], 'item')
			</div>
			<div class="section-title-small">
				<h3 class="h3">Мероприятия</h3>
			</div>

			@foreach($department->events_by_date ?? [] as $date => $events)
				<div class="activities-card-container">

					@foreach($events as $event)

						@if($loop->first)

							@if($past ?? null)
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
		@include('components.layouts.sections.popup', ['title' => $department->name])
	@endpush
@endsection



