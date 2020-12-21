@extends('layouts.app')

@section('title', 'Мероприятия')

@section('content')
	<div class="fade"></div>
	<section class="activities-page-section">
		@section('header')
			@include('components.layouts.includes.header')
			@include('components.layouts.includes.mobile-menu')
		@show
		<div class="activities-page-content container container_small">
			@include('components.layouts.includes.collapses')
			@include('components.layouts.sections.title-with-filter')
			<div class="activities-card-container">
				@include('components.layouts.sections.activities-card-with-date')
				@include('components.layouts.sections.activities-card-no-date')
				@include('components.layouts.sections.activities-card-no-date')
			</div>
			<div class="activities-card-container">
				@include('components.layouts.sections.activities-card-with-date')
				@include('components.layouts.sections.activities-card-past-activity')
			</div>
			<div class="activities-card-container">
				@include('components.layouts.sections.activities-card-with-date')
				@include('components.layouts.sections.activities-card-no-date')
			</div>
		</div>

	</section>
	@include('components.layouts.sections.popup', ['title' => 'Мероприятия'])
@endsection

