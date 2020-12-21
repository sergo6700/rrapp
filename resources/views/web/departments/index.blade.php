@extends('layouts.extend')

@section('title', $title)
@section('description', $description)
@section('breadcrumbs', Breadcrumbs::render('departments'))

@section('content.child')

	<div class="section-content">
		<div class="container container_small">

			<div class="title-with-filters title-with-filters_small">
				<div class="title-with-filters__content">
					<div class="title-with-filters__title">
						<h1 class="h2 text_semi-bold">Подразделения</h1>
					</div>
				</div>
			</div>

			<div class="services-container services-container_small">
				@each('components.layouts.includes.department-card', $items, 'item')
			</div>
			@include('components.layouts.includes.pagination', ['paginator' => $items])

		</div>
	</div>

	@push('popup')
		@include('components.layouts.sections.popup', ['title' => $title])
	@endpush
@endsection
