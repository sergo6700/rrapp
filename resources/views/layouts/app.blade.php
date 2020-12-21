<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head itemscope itemtype="http://schema.org/WPHeader">
		@include('components.layouts.includes.analytics')

		<meta charset="utf-8">
		<meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta itemprop="description" name="description" content="@yield('description')">
		<title itemprop="headline">@yield('title')</title>

		<meta property="og:url" content="{{ Request::url() }}">
		<meta property="og:title" content="@yield('title')">
		<meta property="og:description" content="@yield('description')">
		<meta property="og:image" content="@yield('meta_og_image')">

		<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet"/>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css"/>
		@stack('styles')

		@include('components.layouts.includes.favicon')

		<link rel="stylesheet" href="{{ mix('css/app.css') }}">
		<!-- dadata styles -->
		<link href="https://cdn.jsdelivr.net/npm/suggestions-jquery@19.8.0/dist/css/suggestions.min.css" rel="stylesheet" />
		<!-- button-bad-visible -->
		<link rel="stylesheet" href="/utils/css/uhpv.css">
		@include('components.layouts.includes.metrika')
		@include('components.layouts.includes.picturefill')
</head>

<body>
	<div id="app">
			{{-- @section('header')
				@include('components.layouts.includes.header')
			@show --}}
			<a name="UpButton"></a>
			<div class="fade"></div>
			<main class="">
				@yield('content')

				@include('components.layouts.sections.side-panel')

				@guest
					@include('components.layouts.sections.popup-registration')
					@include('components.layouts.sections.popup-authorization')
				@endguest
				@auth
					@include('components.layouts.sections.popup-registration-step-2')
				@endauth
			</main>

			@section('footer')
				@include('components.layouts.includes.footer')
			@show
	</div>

	<script  src="/utils/js/jquery-3.4.1.min.js"></script>
	@guest
	<script src="//ulogin.ru/js/ulogin.js"></script>
	@endguest
    <script src="/utils/js/swiper.min.js"></script>
    <script src="https://kit.fontawesome.com/2645a5dd7f.js"></script>
	<script src="https://www.google.com/recaptcha/api.js?onload=recaptchaCallback&render=explicit&hl=ru" async defer></script>
	<script type="text/javascript">
		var widgetRecaptchaResgistration,
				widgetRecaptchaFeedback,
				widgetRecaptchaService;

		var recaptchaCallback = function () {
			let option = {
				sitekey: "{{ env('CAPTCHA_KEY') }}"
			};

			if ($('#recaptchaResgistration').length > 0) {
				widgetRecaptchaResgistration = grecaptcha.render("recaptchaResgistration", option);
			}

			if ($('#recaptchaResgistration-step2').length > 0) {
				widgetRecaptchaResgistration = grecaptcha.render("recaptchaResgistration", option);
			}

			if ($('#recaptchaFeedback').length > 0) {
				widgetRecaptchaFeedback = grecaptcha.render("recaptchaFeedback", option);
			}
		}
	</script>

	<script src="{{ mix('js/app.js') }}"></script>

	<!-- button-bad-visible -->
	<script src="/utils/js/uhpv.min.js"></script>
	<script src="/utils/js/fitie.js"></script>
	<script src="/utils/js/jquery.mask.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
	<!-- dadata js -->
	<script src="https://cdn.jsdelivr.net/npm/suggestions-jquery@19.8.0/dist/js/jquery.suggestions.min.js"></script>
	@stack('scripts')

	<script src="//code.jivosite.com/widget.js" data-jv-id="tM0cjhYv1m" async></script>
</body>
</html>
