@extends('layouts.app')

@section('title', 'Мероприятие')

@section('content')
	<div class="fade"></div>
	<section class="activity-page-section">
		@section('header')
			@include('components.layouts.includes.header')
			@include('components.layouts.includes.mobile-menu')
		@show
		<div class="activity-page-content">
			<div class="container container_small">
				@include('components.layouts.includes.collapses')
				<h2 class="h2 section-title activity-page-title">Бесплатные налоговые консультации для предпринимателей — каждый понедельник</h2>
				<div class="template-text-container activity-column-container">
					<div class="activity-column-text">
						<img src="/img/pictures/signup-bg.jpg" alt="">
						<p>Приглашаем предпринимателей, собственников бизнеса, бухгалтеров и финансистов на бесплатные очные налоговые консультации от ведущего специалиста по бухгалтерскому учету ООО «Аудит-Вела» Бухлаковой Ольги.</p>
						<p>На консультации Ольга расскажет о сроках сдачи отчетности и уплате налогов, порядке заполнения налоговых деклараций, порядке проведения камеральных и выездных налоговых проверок. Вы узнаете о выборе системы налогообложения, подготовке ответов налогоплательщиков на требования налоговых органов, порядке заполнения заявлений на получение патента по различным видам деятельности, сможете задать все интересующие вас вопросы.</p>
						<img src="/img/pictures/signup-bg.jpg" alt="">
						<p>Консультации бесплатные. Регистрация обязательна. Дополнительную информацию можно получить по телефону 8 (863) 308-19-11 (доб. 306) или по почте cymbal@rrapp.ru (контактное лицо: Цымбал Виктория).</p>
						<p>На консультации Ольга расскажет о сроках сдачи отчетности и уплате налогов, порядке заполнения налоговых деклараций, порядке проведения камеральных и выездных налоговых проверок. Вы узнаете о выборе системы налогообложения, подготовке ответов налогоплательщиков на требования налоговых органов, порядке заполнения заявлений на получение патента по различным видам деятельности, сможете задать все интересующие вас вопросы.</p>
					</div>
					<div class="activity-column-brief">
						@include('components.layouts.includes.brief-card')
						<button class="button button_big button_brown button_rounded activity-column-brief__button"><span class="text text_solid text_23 text_PT-font">Зарегистрироваться</span></button>
					</div>
				</div>
			</div>
			@include('components.layouts.sections.map')
            @include('components.layouts.includes.mobile-map-popup')
			<div class="container container_small">
				<div class="template-text-container">
					<h3>Я спикер</h3>
					<p>В развитых странах подавляющее большинство решений в бизнесе и госуправлении, принимается на основе геоданных. «Точки на карте» полезны в целом ряде отраслей, включая ретейл, логистику, транспортную и банковскую сферы. Новые технологии позволяют нам лучше исследовать мир вокруг нас, а в больших городах без специальных знаний о населении и объектах вокруг стало практически невозможно вести бизнес. </p>
					<p>Предпринимательство — это прежде всего люди. Люди, наиболее чувствительные к изменениям в среде и обществе, самые активные потребители новых продуктов. Именно они первыми начинают использовать те возможности, в том числе и технологические, которые диктует новое время.</p>
				</div>
				<button class="button button_big button_brown button_rounded button_spiker"><span class="text text_solid text_23 text_PT-font">Связаться</span></button>
			</div>
		</div>
	</section>
	@include('components.layouts.sections.popup', ['title' => 'Мероприятие'])
@endsection
@push('scripts')
	<script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
	integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
	crossorigin=""></script>
	<script>
		var map = L.map('map', {
			center: [47.231004, 39.734451],
			zoom: 14,
			zoomControl: false,
			scrollWheelZoom: false
		});

		var custimIcon = L.icon({
			iconUrl: '/img/icons/map-geo-icon.svg',
		})

		map.once('focus', function() { map.scrollWheelZoom.enable(); });

		L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
			attribution:
				'Tiles by <a href="http://mapc.org">MAPC</a>, Data by <a href="http://mass.gov/mgis">MassGIS</a>',
			maxZoom: 19,
			minZoom: 13,
		}).addTo(map);

		L.marker([47.227415, 39.742931], {icon: custimIcon}).addTo(map);
		map.invalidateSize();
	</script>
@endpush

