@extends('layouts.app')

@section('title', 'Подразделение')

@section('content')
	<div class="fade"></div>
	<section class="page-section">
		@section('header')
			@include('components.layouts.includes.header')
			@include('components.layouts.includes.mobile-menu')
		@show
		<div class="subdivision-page-content">
			<div class="container container_small">
				@include('components.layouts.includes.collapses')
				@include('components.layouts.sections.title-with-single-button')
				<div class="section-title-small">
					<h3 class="h3">Меры поддержки</h3>
				</div>
				<div class="services-container">
					@include('components.layouts.includes.services-card-with-tag')
					@include('components.layouts.includes.services-card-with-tag')
					@include('components.layouts.includes.services-card-with-tag')
				</div>
				<div class="section-title-small">
					<h3 class="h3">Мероприятия</h3>
				</div>
				<div class="activities-card-container">
					@include('components.layouts.sections.activities-card-with-date_plain')
				</div>
				<div class="activities-card-container">
					@include('components.layouts.sections.activities-card-with-date_plain')
					@include('components.layouts.sections.activities-card-no-date_plain')
				</div>
				@include('components.layouts.includes.template-block-small')
			</div>
		</div>
	</section>
	@include('components.layouts.sections.popup', ['title' => 'Подразделение'])
@endsection


