@extends('layouts.app')

@section('title', '404')

@section('content')
	<div class="fade"></div>
	<section class="page-section">
		@section('header')
			@include('components.layouts.includes.header')
			@include('components.layouts.includes.mobile-menu')
		@show
		<div class="notFound-content">
			<span class="text text_96 text_massive text_red-1 notFound-content__title">404</span>

			@if (!empty($message))
				<h3 class="h3 text_center notFound-content__small-title">{{ $message }}</h3>
			@else
				<h3 class="h3 text_center notFound-content__small-title">Страница не найдена</h3>
				<span class="text text_17 text_center notFound-content__text">Запрашиваемая вами страница не найдена или такой страницы не существует</span>
			@endif

			<a class="button button_rounded button_big button_brown link notFound-content__button" href="{{ url('/') }}">
				<span class="text text_23 text_white text_PT-font">Вернуться на главную</span>
			</a>
		</div>
	</section>
	@include('components.layouts.sections.popup', ['title' => '404'])
@endsection


