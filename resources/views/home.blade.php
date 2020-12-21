@extends('layouts.app')

@section('title', $title)
@section('description', $description)

@push('styles')
	<link rel="stylesheet" href="/utils/css/swiper.min.css">
@endpush

@section('content')
	<section class="signup-section">
		@section('header')
			@include('components.layouts.includes.header')
			@include('components.layouts.includes.mobile-menu')
		@show
		<div class="signup-section__content">
			<h1 class="h1 text_white signup-section__title">
				«Горячая линия» центра «Мой бизнес»
			</h1>

			<h2 class="h1 text_white signup-section__title"><a href="tel:+78043333231" onclick="gtag('event','click',{'event_category':'zvonok'})" class="link">8 (804) 333-32-31</a></h2>

			@if($hot_news)
			<a href="{{ route('news.show', ['slug' => $hot_news->slug]) }}"
			   class="button link button_rounded button_small button_brown button_hot_news"
			><span class="text text_bold text_36 text_PT-font">Ответы на частые вопросы «Горячей линии»</span></a>
			@endif

			<p class="text text_white text_28 text_slim signup-section__text">
				<span>Мы отвечаем на обращения предпринимателей</span>
				<span>ежедневно:</span>
				<span>с 8:00 до 21:00</span>
			</p>

			@if (false)
				@auth
					<p class="text text_white text_28 text_slim signup-section__text">Единый портал, на котором Вы можете получить все необходимые услуги для начала, ведения и развития предпринимательской деятельности</p>
				@endauth

				@guest
				<p class="text text_white text_28 text_slim signup-section__text">Войдите или зарегистрируйтесь, чтобы воспользоваться услугами
				Ростовского регионального Центра «Мой бизнес»</p>
				@endguest
			@endif

			@guest
			<div class="signup-section__buttons-group">
				<button class="button button_rounded button_big button_brown button-show-popup-registration"><span class="text text_bold text_23 text_PT-font">Регистрация</span></button>
				<button class="button button_rounded button_big button_transparent button-show-popup-enter"><span class="text text_bold text_23 text_PT-font">Вход</span></button>
			</div>
			@endguest

			<div class="signup-section__links-groups signup-section__founder">
				<a href="https://mineconomikiro.donland.ru" target="_blank" class="link text text_white text_16 text_slim signup-section__texts"><strong>Учредитель</strong> - Министерство экономического развития Ростовской области</a>
			</div>

			<div class="signup-section__links-groups">
				<div class="signup-section__link">
					<a class="link signup-section__link-first" target="blank" aria-label="Официальный портал Правительства Ростовской области" href="https://www.donland.ru/"></a>
				</div>
				<div class="signup-section__link">
					<a class="link signup-section__link-second" target="blank" aria-label="Министерство экономического развития Ростовской области" href="https://mineconomikiro.donland.ru"></a>p
				</div>
				<div class="signup-section__link">
					<a class="link signup-section__link-third"
					   aria-label="«Ростовское региональное агентство поддержки предпринимательства»"
					   target="blank" href="http://www.rrapp.ru/"></a>
				</div>
			</div>
		</div>
			<a name="actual"></a>
	</section>

	@include('components.layouts.sections.actual-slider')

	<section class="services-section" id="services">
		<a name="services"></a>
		<div class="container container_small">
			<h2 class="h2 section-title">Меры поддержки</h2>
			<div class="services-container">
				@foreach($services ?? [] as $item)
					@include('components.layouts.includes.services-card-with-tag')
				@endforeach
			</div>
			<div class="section-link-wrapper">
				<div class="section-link-arrow">
					<a class="section-link text_solid text_28 text_beige" href="{{ route('service') }}">
						Меры поддержки
					</a>
					<svg class="arrow-icon" width="23" height="15" viewBox="0 0 23 15" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0.624997 8.70833L17.7471 8.70834L13.4212 13.0463L15.125 14.75L22.375 7.5L15.125 0.250006L13.4213 1.95375L17.7471 6.29167L0.624997 6.29167L0.624997 8.70833Z" fill="#C59368"></path>
					</svg>
				</div>
			</div>
			<a class="button button_mobile button_brown" href="{{ route('service') }}">
				<span class="text_semi-bold text_PT-font text_12 text_white">Меры поддержки</span>
			</a>
		</div>
	</section>

	<section class="calendar-section" id="calendar">
		<a name="calendar"></a>
        <div class="container container_small"><h2 class="h2 section-title">Мероприятия</h2></div>
        <div class="calendar-line"></div>
		@include('components.layouts.sections.timeline')
        <div class="container container_small">
			<div class="section-link-wrapper section-link-wrapper_small">
				<div class="section-link-arrow">
					<a href="{{route('event')}}" class="section-link text_solid text_28 text_beige">
						Все мероприятия
					</a>
					<svg class="arrow-icon" width="23" height="15" viewBox="0 0 23 15" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0.624997 8.70833L17.7471 8.70834L13.4212 13.0463L15.125 14.75L22.375 7.5L15.125 0.250006L13.4213 1.95375L17.7471 6.29167L0.624997 6.29167L0.624997 8.70833Z" fill="#C59368"></path>
					</svg>
				</div>
			</div>
			<a href="{{route('event')}}" class="button button_mobile button_brown">
				<span class="text_semi-bold text_PT-font text_12 text_white">Все мероприятия</span>
			</a>
        </div>
	</section>

	<section class="articles-section" id="articles">
		<a name="articles"></a>
		<div class="container container_small">
			<h2 class="h2 section-title">База знаний</h2>
			<div class="articles-container">
				@include('components.layouts.includes.article-card-big', ['item' => $articles->first() ?? null])
				@foreach($articles->slice(1) ?? [] as $item)
					@include('components.layouts.includes.article-card-small')
				@endforeach
			</div>
			<div class="section-link-wrapper">
				<div class="section-link-arrow">
					<a class="section-link text_solid text_28 text_beige" href="{{ route('article.index') }}">
						База знаний
					</a>
					<svg class="arrow-icon" width="23" height="15" viewBox="0 0 23 15" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0.624997 8.70833L17.7471 8.70834L13.4212 13.0463L15.125 14.75L22.375 7.5L15.125 0.250006L13.4213 1.95375L17.7471 6.29167L0.624997 6.29167L0.624997 8.70833Z" fill="#C59368"></path>
					</svg>
				</div>
				<a class="button button_mobile button_brown" href="{{ route('article.index') }}">
					<span class="text_semi-bold text_PT-font text_12 text_white">Все статьи</span>
				</a>
			</div>
		</div>
	</section>
	<section class="docs-section">
		<div class="container container_small">
			<h2 class="h2 section-title">Нормативные документы</h2>
		</div>
		<div class="container container_slider">
			<div class="swiper-docs-container">
				<div class="swiper-pagination"></div>
				<div class="swiper-wrapper">
					@include('components.layouts.includes.docs-card')
				</div>
			</div>
		</div>
		<div class="mobile-docs-container">
			@include('components.layouts.includes.docs-card')
			<div class="section-link-wrapper">
				<a href="{{ route('docs.index') }}" class="button button_mobile button_brown text_no-underline mobile-docs-container__button">
					<span class="text_semi-bold text_PT-font text_12 text_white">Все документы</span>
				</a>
			</div>
		</div>
	</section>

	@include('components.layouts.sections.popup', ['title' => $title])

	@auth
		@if(auth()->user()->hasVerifiedEmail())
			@include('components.layouts.sections.popup-your-mail-is-confirmed')
		@endif
	@endauth

@endsection
@push('scripts')
	<script src="/utils/js/jquery-ui.min.js"></script>
	<script>
		var swiper = new Swiper('.swiper-container', {
			slidesPerView: 'auto',
			loop: false,
			loopedSlides: 200,
			spaceBetween: 0,
			freeMode: true,
			keyboard: {
				enabled: true,
				onlyInViewport: false,
			},
			observer: true,
			observeParents: true,
		});
	</script>
@endpush

