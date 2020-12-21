@extends('layouts.extend')

@section('title', $event->title)
@section('description', \App\Support\Seo\SeoUtils::prepareDescription($event->content))
@section('breadcrumbs', Breadcrumbs::render('events.show', $event))

@section('content.child')
	<div class="section-content">
		<div class="container container_small" itemscope itemtype="http://schema.org/Event">

				<h1 class="h2 section-title activity-page-title" itemprop="name">{{ $event->title }}</h1>
				<div class="template-text-container activity-column-container">
					<div class="activity-column-text">
						<meta itemprop="image" content="{{ url('/img/icons/logo-dark-icon.svg') }}">
						<meta itemprop="description" content="{{ $event->short_content }}">
						{!! $event->full_content !!}
					</div>
					<div class="activity-column-brief activity-column-brief--sticky-content">
						<div class="brief-wrapper">
							@include('components.layouts.includes.brief-card')

							@if(!$event->passed)

								@if(Session::get('CompleteRegistration') && $event->id === 161)
									<script type="text/javascript">
										window.onload = function() {
											console.log(3343)
											fbq('track', 'CompleteRegistration');
										};
									</script>
								@endif

								@if ($event->registrations->contains('user_id', auth()->id()))
									<form action="{{ route('registration.event.cancel', ['event' => $event->id]) }}" method="POST">
										@csrf
										<input type="hidden" name="_method" value="delete">
										<button class="button button_big button_transparent_contrast button_rounded activity-column-brief__button">
											<span class="text text_bold text_23 text_PT-font">Отменить регистрацию</span>
										</button>
									</form>
								@elseif ($event->is_limit_reached)
									<div class="button button_big button_red_1 button_rounded activity-column-brief__button">
										<span class="text text_bold text_23 text_PT-font">Регистрация закрыта</span>
									</div>
								@elseif (!auth()->check())
									<button class="button button_big button_brown button_rounded activity-column-brief__button button-show-popup-enter">
										<span class="text text_bold text_23 text_PT-font">Зарегистрироваться</span>
									</button>
								@else
									<form id="register-to-event" action="{{ route('registration.event.create') }}" method="POST">
										@csrf
										<input type="hidden" name="event_id" value="{{ $event->id }}">
										<button class="button button_big button_brown button_rounded activity-column-brief__button">
											<span class="text text_bold text_23 text_PT-font">Зарегистрироваться</span>
										</button>
									</form>
								@endif
							@endif
						</div>
					</div>
				</div>
		</div> <!-- /.container -->

		@include('components.layouts.sections.map', ['address' => $event->address->title])
		@include('components.layouts.includes.mobile-map-popup')
		<div class="container container_small">
			<div class="template-text-container">
				<h3>Я - спикер</h3>
				<p>Если вы спикер, бизнес-тренер, коуч, маркетолог, предприниматель и хотите делиться своими навыками и опытом на мастер-классах, тренингах и семинарах, то мы будем рады видеть вас в числе наших партнеров по образовательной деятельности.</p>
			</div>
			<button class="button button_big button_brown button_rounded button_spiker show-popup-button" data-subject_id="1">
				<span class="text text_solid text_23 text_PT-font">Связаться</span>
			</button>
		</div>
	</div> <!-- /.section-content -->

	@push('popup')
		@include('components.layouts.sections.popup', ['title' => $event->title])
	@endpush
@endsection












@push('scripts')
	<script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
			integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
			crossorigin=""></script>
	<script>
		$(document).ready(function() {

			var map = L.map('map', {
				center: [{{ $event->address->latitude ?? 47.231004 }}, {{ $event->address->longitude ?? 39.734451 }}],
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

			L.marker([{{ $event->address->latitude ?? 47.227415 }}, {{ $event->address->longitude ?? 39.742931 }}], {icon: custimIcon}).addTo(map);
			map.invalidateSize();
		});

	</script>
@endpush