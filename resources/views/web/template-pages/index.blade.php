@extends('layouts.app')

@section('title', 'Заголовок страницы')

@section('content')
	<div class="fade"></div>
	<section class="page-section">
		@section('header')
			@include('components.layouts.includes.header')
			@include('components.layouts.includes.mobile-menu')
		@show
		<div class="template-page-content container container_small">
			@include('components.layouts.includes.collapses')
			<div class="template-page-title">
				<h2 class="h2 text_semi-bold">Контакты</h2>
			</div>
			<div class="template-text-container">
				<h4>Адрес:</h4>
				<p>344006, г. Ростов-на-Дону, БЦ "Балканы", ул. Седова 6/3, 1 этаж / оф. 310</p>
				<h4>График работы:</h4>
				<p>Понедельник - пятница с 9:00 до 18:00</p>
				<h4>Телефоны:</h4>
				<ul>
					<li>+7 (863) 308 19 11 — Центральный офис (Седова 6/3)</li>
					<li>+7 (804) 333 32 31 — Горячая линия (центр поддержки предпринимательства)</li>
					<li>+7 (863) 240 38 13 — Бизнес - Инкубатор (Социалистическая, 53)</li>
					<li>+7 (863) 231 44 62 — Бизнес - Инкубатор (Думенко 1/3)</li>
				</ul>
				<img src="/img/pictures/signup-bg.jpg" alt="" class="template-page-img">
			</div>
		</div>
		@include('components.layouts.sections.popup', ['title' => 'Заголовок страницы'])
		@include('components.layouts.sections.popup-registration')
	</section>
@endsection
