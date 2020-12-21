@extends('layouts.extend')

@section('title', $service->title)
@section('description', \App\Support\Seo\SeoUtils::prepareDescription($service->short_content))
@section('breadcrumbs', Breadcrumbs::render('services.show', $service))

@section('content.child')
	<div class="section-content">
		<div class="container container_small">

			<div class="title-with-filters title-with-filters_small">
				<div class="title-with-filters__content content-service">
					<div class="title-with-filters__title title-service">
						<h1 class="h2 text_semi-bold">{{ $service->title }}</h1>
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

			@include('components.layouts.includes.section-tag', ['tags' => $service->tags ?? null, 'small' => true])

			<div class="service-content">
				<div class="content-info">
					<div class="content-info__head">
						<h4 class="service-content__title h4 text text_18 text_semi-bold">Организация:
							<a class="service-content__text text text_beige text_no-underline"
							   href="{{ route('department.show', $service->division->only('slug')) }}">
								{{ $service->division->name ?? null }}
							</a>
						</h4>
					</div>
					<div class="content-info__description template-text-container">
						{!! $service->full_content ?? null !!}
					</div>
				</div>

				<div class="card-hover service-form-block">
					<form action="{{ route('service.send-feedback', $service->only('slug')) }}" class="service-form" method="post">
						@csrf
						<input type="hidden" name="page_url" value="{{url()->current()}}">
						<h4 class="service-form__title h4 text text_18 text_semi-bold text_brown">{{ $service->title ?? null }}</h4>
						<div class="textarea_service">
							<textarea id="content-field" class="textarea text text_19 text_PT-font {{ $errors->has('content') ? 'error' : '' }}" name="content" placeholder="Текст сообщения*"></textarea>
							@error('content')
							<label id="content-error" for="content-field" class="error">{{ $message }}</label>
							@enderror
						</div>

						<input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
						@error('g-recaptcha-response')
						<label id="captcha-error" for="captcha-field" class="error">{{ $message }}</label>
						@enderror

						@if(session()->get('success') ?? null)
							@if (isset($instagram_page_id))
								<script>
									window.onload = function() {
										/**
										 * отправляем google analytics и Яндекс Метрику в том случае, если выполнено оба условия:
										 * 1) форма на странице сервиса успешно отправилась
										 * 2) и это страница с "Оказание услуг по созданию онлайн-страницы в социальной сети Instagram"
										 */
										gtag('event','click',{'event_category':'instagram'});
										ym(55128721,'reachGoal','usluga_instagram');
									};
								</script>
							@endif
							@if (isset($marketplace_page_id))
								<script>
									window.onload = function() {
										/**
										 * отправляем google analytics и Яндекс Метрику в том случае, если выполнено оба условия:
										 * 1) форма на странице сервиса успешно отправилась
										 * 2) и это страница с "Оказание услуг по содействию в размещении на электронных торговых площадках"
										 */
										gtag('event','click',{'event_category':'market'});
										ym(55128721,'reachGoal','usluga_marketplace');
									};
								</script>
							@endif
							<div id="popup-success-show"></div>
						@endif

						<button class="button button_service button_rounded button_big button_brown {{ auth()->guest() ? 'button-show-popup-enter' : '' }}">
							<span class="text text_bold text_23 text_PT-font">Отправить</span>
						</button>
					</form>
				</div>

			</div>
		</div> <!-- /.container -->
	</div> <!-- /.section-content -->

	<script src="https://www.google.com/recaptcha/api.js?render={{ env('CAPTCHA_KEY_V3') }}"></script>
	<script>
		grecaptcha.ready(function() {
			grecaptcha.execute("{{ env('CAPTCHA_KEY_V3') }}", {action: 'homepage'}).then(function(token) {
				console.log(token)
				document.getElementById('g-recaptcha-response').value = token;
			});
		});
	</script>

	@push('popup')
		@include('components.layouts.sections.popup', ['title' => $service->title])
	@endpush
@endsection