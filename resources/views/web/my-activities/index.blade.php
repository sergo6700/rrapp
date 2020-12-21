@extends('layouts.app')

@section('title', 'Личный кабинет')

@push('styles')
	<link rel="stylesheet" href="/utils/css/swiper.min.css">
@endpush

@section('content')
	<div class="fade"></div>
	<section class="my-activities-section">
		@section('header')
			@include('components.layouts.includes.header')
			@include('components.layouts.includes.mobile-menu')
		@show
		<div class="my-activities-content container container_small">
			@include('components.layouts.includes.collapses')
			<h2 class="h2 section-title">Личный кабинет</h2>
			<div class="container_my-activities-slider">
				<div class="swiper-my-activities-container">
					<div class="swiper-pagination"></div>
					<div class="swiper-wrapper">
						@include('components.layouts.includes.my-activities.personal-info')
						@include('components.layouts.includes.my-activities.my-activities')
						@include('components.layouts.includes.my-activities.notifications')
					</div>
				</div>
			</div>
		</div>
	</section>
	@include('components.layouts.sections.popup', ['title' => 'Личный кабинет'])
@endsection
@push('scripts')
	<script>
		var titles=['Персональная информация','Мои мероприятия','Уведомления'];

		var personal = '<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">' +
			'<path d="M8 8C10.21 8 12 6.21 12 4C12 1.79 10.21 0 8 0C5.79 0 4 1.79 4 4C4 6.21 5.79 8 8 8ZM8 10C5.33 10 0 11.34 0 14V16H16V14C16 11.34 10.67 10 8 10Z" fill="currentColor"/>' +
			'</svg>';
		var events = '<svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">' +
			'<path d="M14 11H9V16H14V11ZM13 0V2H5V0H3V2H2C0.89 2 0.00999999 2.9 0.00999999 4L0 18C0 19.1 0.89 20 2 20H16C17.1 20 18 19.1 18 18V4C18 2.9 17.1 2 16 2H15V0H13ZM16 18H2V7H16V18Z" fill="currentColor"/>' +
			'</svg>';
		var notifications = '<svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">' +
			'<path d="M8 20C9.1 20 10 19.1 10 18H6C6 19.1 6.89 20 8 20ZM14 14V9C14 5.93 12.36 3.36 9.5 2.68V2C9.5 1.17 8.83 0.5 8 0.5C7.17 0.5 6.5 1.17 6.5 2V2.68C3.63 3.36 2 5.92 2 9V14L0 16V17H16V16L14 14Z" fill="currentColor"/>' +
			'</svg>';

		var titles_mobile = [personal, events, notifications];

		new Swiper('.swiper-my-activities-container', {
			slidesPerView: 1,
			centeredSlides: true,
			simulateTouch:false,
			pagination: {
				el: '.swiper-pagination',
				clickable: true,
				renderBullet: function (index, className) {
					return '<span class="' + className + '">' + titles[index] + '</span>';
				},
			},
			breakpoints: {
				835: {
					pagination: {
						renderBullet: function (index, className) {
							return '<span class="' + className + '">' + titles_mobile[index] + '<span class="swiper-pagination__mobile__label">' + titles[index] + '</span></span>';
						}
					}
				}
			}
		});
	</script>
@endpush
