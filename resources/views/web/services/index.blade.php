@extends('layouts.extend')

@section('title', $title)
@section('description', $description)
@section('breadcrumbs', Breadcrumbs::render('services'))

@section('content')
	<div class="fade"></div>
	<section class="services-page-section">
		@section('header')
			@include('components.layouts.includes.header')
			@include('components.layouts.includes.mobile-menu')
		@show
		<div class="collapses-container container_small">
			@include('components.layouts.includes.collapses')
		</div>

		<div class="section-content">
			<div id="container-services" class="container container_small">

				<div class="title-with-filters title-with-filters_small">
					<div class="title-with-filters__content">
						<div class="title-with-filters__title">
							<h2 class="h2 text_semi-bold">Меры поддержки</h2>
						</div>

						@if ($tags ?? null)
						<div class="title-with-filters__buttons">
							<button class="button button_rounded button_grey-border-tr button-tag">
								<span class="text text_bold text_17 text_black">Все теги</span>
								<svg width="16" height="10" class="button-tag__icon" viewBox="0 0 16 10" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M1.17366 1.15946C1.56389 0.769238 2.19646 0.768893 2.58711 1.15869L7.29366 5.855C7.68401 6.24449 8.31599 6.24449 8.70634 5.855L13.4129 1.15869C13.8035 0.768893 14.4361 0.769238 14.8263 1.15946L15.2929 1.62602C15.6834 2.01654 15.6834 2.64971 15.2929 3.04023L8.70711 9.62602C8.31658 10.0165 7.68342 10.0165 7.29289 9.62602L0.707106 3.04023C0.316582 2.64971 0.316582 2.01654 0.707107 1.62602L1.17366 1.15946Z" fill="black"/>
								</svg>
							</button>
						</div>
						@endif

					</div>
				</div>

				@include('components.layouts.includes.section-tag-for-list-services', ['tags' => $tags ?? null, 'selected_tags' => $selected_tags  ?? null])
				@include('components.layouts.includes.list-services-with-pagination', ['services' => $services])

		</div> <!-- /.container -->
	</div> <!-- /.section-content -->

	@push('popup')
		@include('components.layouts.sections.popup', ['title' => $title])
	@endpush

@endsection

