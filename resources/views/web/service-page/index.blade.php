@extends('layouts.app')

@section('title', 'Меры поддержки')

@section('content')
	<div class="fade"></div>
	<section class="page-section">
		@section('header')
			@include('components.layouts.includes.header')
			@include('components.layouts.includes.mobile-menu')
		@show
		<div class="collapses-container container_small">
			@include('components.layouts.includes.collapses')
		</div>
		
		<div class="section-content">
			<div class="container container_small">

				<div class="title-with-filters title-with-filters_small">
					<div class="title-with-filters__content content-service">
						<div class="title-with-filters__title title-service">
							<h2 class="h2 text_semi-bold">Макрозаймы на льготных условиях для МСП</h2>
						</div>
						<div class="title-with-filters__buttons buttons-service">
							<button class="button button_rounded button_grey-border-tr button-tag button-tag_service">
								<span class="text text_bold text_17 text_black">Все теги</span>
								<svg width="16" height="10" class="button-tag__icon" viewBox="0 0 16 10" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M1.17366 1.15946C1.56389 0.769238 2.19646 0.768893 2.58711 1.15869L7.29366 5.855C7.68401 6.24449 8.31599 6.24449 8.70634 5.855L13.4129 1.15869C13.8035 0.768893 14.4361 0.769238 14.8263 1.15946L15.2929 1.62602C15.6834 2.01654 15.6834 2.64971 15.2929 3.04023L8.70711 9.62602C8.31658 10.0165 7.68342 10.0165 7.29289 9.62602L0.707106 3.04023C0.316582 2.64971 0.316582 2.01654 0.707107 1.62602L1.17366 1.15946Z" fill="black"/>
								</svg>
							</button>
						</div>
					</div>
				</div>

				@include('components.layouts.includes.section-tag')
				@include('components.layouts.includes.section-tag-active')

				<div class="service-content">
					<div class="content-info">
						<div class="content-info__head">
							<h4 class="service-content__title h4 text text_18 text_semi-bold">Организация: <span class="service-content__text text text_beige">Мой бизнес</span></h4> 
						</div>
						<div class="content-info__description template-text-container">
							<p> Сегодня поддержка малого и среднего предпринимательства является одной из наиболее важных задач государства. Чтобы поддержать действующих предпринимателей, в нашем регионе создана и функционирует такая организация инфраструктуры поддержки субъектов МСП, как АО «Микрофинансовая компания предпринимательского финансирования Пермского края», основным видом деятельности которой является предоставление государственных микрозаймов бизнесу.</p> 
							<p>Сегодня поддержка малого и среднего предпринимательства является одной из наиболее важных задач государства. Чтобы поддержать действующих предпринимателей, в нашем регионе создана и функционирует такая организация инфраструктуры поддержки субъектов МСП, как АО «Микрофинансовая компания предпринимательского финансирования Пермского края»</p>
						</div>
					</div>

					<div class="card-hover service-form-block">
						<form action="" class="service-form">
							<h4 class="service-form__title h4 text text_18 text_semi-bold text_brown">Микрозаймы на льготных условиях для МСП</h4>
							<textarea class="textarea textarea_service text text_19 text_PT-font" name="service-text" placeholder="Текст сообщения*"></textarea>
							<div class="g-recaptcha" data-sitekey="6LdcPa8UAAAAAMJZv30LwfIZQaORSLdlUG20PnZW"></div>
							<button class="button button_service button_rounded button_big button_brown">
								<span class="text text_bold text_23 text_PT-font">Отправить</span>
							</button>
						</form>
					</div>

				</div>

		</div>
	</section>
	@include('components.layouts.sections.popup', ['title' => 'Меры поддержки'])
@endsection