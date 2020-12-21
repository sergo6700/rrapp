<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>РРАПП</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style>
			@import url('https://fonts.googleapis.com/css?family=PT+Sans:400,700&display=swap&subset=cyrillic-ext');
			@font-face {
				font-family: 'Circe';
				src: url('./fonts/Circe.eot') format('eot');
				src: url('./fonts/Circe.eot?#iefix') format('embedded-opentype');
				src: url('./fonts/Circe.woff') format('woff');
				src: url('./fonts/Circe.ttf') format('truetype');
				font-weight: normal;
				font-style: normal;
			}
			body {
				position: relative;
				margin: 0;
				padding: 0;
				min-width: 320px;
				font-family: "PT Sans", sans-serif;
				color: black;
				overflow-x: hidden;
			}
			a {
				color: inherit;
				cursor: pointer;
			}
			p {
				margin: 0;
			}
			button {
				margin: 0;
				padding: 0;
				font-family: inherit;
				background: none;
				border: none;
				cursor: pointer;
			}
			button::before {
				box-sizing: border-box;
			}
			button::after {
				box-sizing: border-box;
			}
			img {
				display: block;
				font-size: 0;
			}
			h3 {
				margin: 0;
			}
			.show {
				display: block!important;
			}
			.hidden {
				display: none;
			}
			.rrapp-iframe-limit-reached {
				width: 100%;
				border-radius: 6px;
				padding: 16px 10px 14px 10px;
				text-align: center;
				background-color: #F17757;
				-webkit-transition: background-color .3s;
				transition: background-color .3s;
				box-sizing: border-box;
			}
			.rrapp-iframe-limit-reached span {
				color: #FFFFFF;
			}
			.rrapp-iframe-custom-checkbox input[type="checkbox"] {
				position: absolute;
				z-index: 2;
				margin: 0;
				cursor: pointer;
				outline: none;
				opacity: 0;
			}
			.rrapp-iframe-container {
				font-family: 'Circe', sans-serif;
				max-width: 1440px;
				min-width: 320px;
				position: relative;
				margin: 0;
				overflow-x: hidden;
				padding: 96px 150px 108px 150px;
				background: #F0F0F0;
			}
			.rrapp-iframe-content {
				display: flex;
				justify-content: space-between;
			}
			.rrapp-iframe-content__text, .rrapp-iframe-content__form {
				max-width: 555px;
				min-width: 270px;
			}
			.rrapp-iframe-content__text {
				margin-right: 30px;
			}
			.rrapp-iframe-content__form {
				box-shadow: 0px 40px 96px rgba(0, 0, 0, 0.1);
			}
			.rrapp-iframe-big-title {
				font-size: 44px;
				color: #562212;
				line-height: 46px;
				font-weight: bold;
				padding-bottom: 20px;
			}
			.rrapp-iframe-text {
				font-size: 28px;
				font-weight: normal;
				line-height: 39px;
			}
			.rrapp-iframe-text_bold {
				font-weight: bold;
			}
			.rrapp-iframe-content__form {
				padding: 55px 50px 55px 50px;
				border-radius: 6px;
				background-color: #fbfbfb;
			}
			.rrapp-iframe-content__form-hover {
				position: relative;
				z-index: 1;
			}
			.rrapp-iframe-content__form-hover::before {
				content: '';
				position: absolute;
				top: 0;
				right: 0;
				bottom: 0;
				left: 0;
				z-index: -1;
				background-color: #fff;
				border-radius: 6px;
			}
			.rrapp-iframe-content__form-hover:hover:before {
				transform: rotate(2.5deg);
			}
			.rrapp-iframe-content__form-hover:hover {
				box-shadow: 0 40px 96px 2px grey;
			}
			.rrapp-iframe-content__form-title {
				color: #562212;
				line-height: 34px;
				width: 100%;
				padding-bottom: 13px;
			}
			.rrapp-iframe-element-container {
				display: flex;
				-webkit-box-orient: vertical;
				-webkit-box-direction: normal;
				flex-direction: column;
				-webkit-box-pack: justify;
				justify-content: space-between;
				margin-bottom: 5px;
				height: 90px;
			}
			.rrapp-iframe-input {
				max-height: 60px;
				padding: 17.5px 24px;
				border: 1px solid #C9CCD4;
				font-size: 19px;
				line-height: 23px;
				font-family: "PT Sans", sans-serif;
				color: #000000;
				border-radius: 6px;
				-webkit-transition: border .3s;
				transition: border .3s;
				outline: none;
			}
			.rrapp-iframe-input:hover {
				border: 1px solid #C59368;
			}
			.rrapp-iframe-input_confirm {
				margin-top: 30px;
			}
			.rrapp-iframe-input_confirm::placeholder {
				font-size: 19px;
				line-height: 32px;
				font-family: "PT Sans", sans-serif;
				color: #000000;
			}
			.rrapp-iframe-input.error {
				border: 1px solid #ed5338;
			}
			.rrapp-iframe-element-container label.error {
				font-size: 14px;
				font-family: "PT Sans", sans-serif;
				color: #ED5338;
			}
			.rrapp-iframe-checkbox-label {
				/*display: flex;*/
				/*align-items: center;*/
				display: table;
				cursor: pointer;
				margin-top: 10px;
				margin-bottom: 15px;
				font-size: 19px;
				line-height: 32px;
				font-family: "PT Sans", sans-serif;
			}
			.rrapp-iframe-checkbox-label_disabled {
				color: #A7A9AC;
			}
			.rrapp-iframe-checkbox-label_disabled .rrapp-iframe-custom-checkbox{
				border: 1px solid #C9CCD4;
				background: #F6F6F6;
			}
			.rrapp-iframe-checkboxes-container {
				display: flex;
				flex-direction: column;
				margin-bottom: 10px;
			}
			.rrapp-iframe-checkboxes-container label.error {
				position: absolute;
				bottom: -20px;
				left: 40px;
				width: 250px;
				font-size: 14px;
				line-height: 16px;
				font-family: "PT Sans", sans-serif;
				color: #ED5338;
			}
			.rrapp-iframe-checkbox-input--wrap {
				display: table-cell;
			}
			.rrapp-iframe-custom-checkbox {
				position: relative;
				z-index: 1;
				display: inline-block;
				width: 25px;
				min-width: 25px;
				height: 25px;
				margin-right: 16px;
				background-color: #fff;
				border-radius: 6px;
				border: 1px solid #C9CCD4;
				cursor: pointer;
			}
			.rrapp-iframe-custom-checkbox.selected {

				background-repeat: no-repeat;
				background-position: center;
				background-color: #C59368;
				border: 1px solid #C59368;
				position: relative;
			}
			.rrapp-iframe-custom-checkbox.selected::after {
				content: url("data:image/svg+xml; utf8, <svg width='15' height='13' viewBox='0 0 15 13' fill='none' xmlns='http://www.w3.org/2000/svg'><path fill-rule='evenodd' clip-rule='evenodd' d='M14.3894 0.469359C14.8436 0.822477 14.9256 1.47692 14.5724 1.93109L6.47351 12.3477C6.29315 12.5797 6.0232 12.7248 5.73019 12.7471C5.43719 12.7694 5.1484 12.6669 4.93501 12.4648L0.533897 8.29816C0.116126 7.90264 0.0980846 7.24334 0.493601 6.82557C0.889118 6.4078 1.54842 6.38976 1.96619 6.78527L5.53354 10.1626L12.9276 0.65234C13.2808 0.198165 13.9353 0.116242 14.3894 0.469359Z' fill='white'/> </svg>");
				display: block;
				position: absolute;
				left: 5px;
				top: -3px;
			}
			.rrapp-iframe-form-message {
				font-size: 19px;
				font-family: "PT Sans", sans-serif;
				color: #A7A9AC;
			}
			.rrapp-iframe-button {
				outline: none;
				display: inline-block;
				text-align: center;
				border-radius: 6px;
				padding: 16px 10px 14px 10px;
				background-color: #C59368;
				transition: background-color .3s;
				width: 100%;
				margin-top: 38px;
			}
			.rrapp-iframe-button:hover {
				background-color: #8E6455;
				transition: background-color .3s
			}
			.rrapp-iframe-button:focus {
				background-color: #704232;
				transition: background-color .3s
			}
			.rrapp-iframe-button:hover span {
				color: #F6F6F6
			}
			.rrapp-iframe-button:focus span {
				color: #F6F6F6
			}
			.rrapp-iframe-button span {
				margin: 0;
				font-family: "PT Sans", sans-serif;
				font-size: 23px;
				line-height: 30px;
				color: #fff;
			}
			.rrapp-iframe-link-container {
				display: table-cell;
				/*padding-left: 10px;*/
				/*display: flex;*/
				/*align-items: flex-end;*/
				margin-top: -10px;
				margin-left: 6px;
			}
			.rrapp-iframe-link {
				/*font-family: "PT Sans", sans-serif;*/
				display: inline;
				/*font-size: 19px;*/
				color: #0055f9;
				/*line-height: 21px;*/
			}
			.rrapp-iframe-star-icon {
				/*align-self:*/
			}
			.rrapp-iframe-content__form-success-msg {
				display: none;
				margin-top: 50px;
				font-size: 24px;
				line-height: 34px;
			}
			.rrapp-iframe-inputs-container {
				display: flex;
				flex-direction: column;
				margin-top: 42px;
			}
			.rrapp-iframe-button-disabled-btn {
				pointer-events: none;
				background-color: #D2BEB6 !important
			}
			@media only screen and (max-width: 1100px) {
				.rrapp-iframe-container {
					padding: 36px 25px 59px 25px;
				}
				.rrapp-iframe-content {
					flex-direction: column;
					align-items: center;
				}
				.rrapp-iframe-content__text {
					margin-right: 0;
					margin-bottom: 20px;
				}
			}
			@media only screen and (max-width: 555px) {
				.rrapp-iframe-content {
					align-items: initial;
				}
				.rrapp-iframe-big-title {
					font-size: 20px;
					line-height: 23px;
					padding-bottom: 10px;
				}
				.rrapp-iframe-text {
					font-size: 17px;
					line-height: 22px;
					padding-bottom: 30px;
				}
				.rrapp-iframe-content__form {
					padding: 35px 25px 55px 25px;
				}
				.rrapp-iframe-checkbox-label {
					font-size: 16px;
					line-height: 21px;
				}
				.rrapp-iframe-element-container {
					height: 70px;
				}
				.rrapp-iframe-input {
					max-height: 48px;
					padding: 15px 14px;
					font-size: 16px;
				}
				.rrapp-iframe-input::placeholder {
					font-size: 16px;
				}
				.rrapp-iframe-custom-checkbox {
					width: 23px;
					min-width: 23px;
					height: 23px;
				}
				.rrapp-iframe-custom-checkbox.selected::after {
					left: 5px;
					top: 3px;
				}
				.rrapp-iframe-form-message {
					font-size: 16px;
					line-height: 21px;
				}
				.rrapp-iframe-button span {
					font-size: 17px;
					line-height: 22px;
				}
			}
		</style>
	</head>
	<body>
	<section class="rrapp-iframe-container">
		<div class="rrapp-iframe-content">
			<div class="rrapp-iframe-content__text">
				<p class="rrapp-iframe-big-title">Регистрация на {{ $event->title }}</p>
				<p class="rrapp-iframe-text">Для участия в мероприятии заполните, пожалуйста, форму и нажмите кнопку «Зарегистрироваться».</p>
			</div>
			<form method="POST" action="{{ route('registration.events.register', ['event' => $event->id]) }}" class="rrapp-iframe-content__form rrapp-iframe-content__form-hover">
				@csrf
				<input type="hidden" name="event_id" value="{{ $event->id }}">
				<h3 class="rrapp-iframe-text rrapp-iframe-text_bold rrapp-iframe-content__form-title">Регистрация на мероприятие</h3>

				<p class="rrapp-iframe-content__form-success-msg @if ($sentSuccessfully) show @endif">Заявка на участие отправлена!</p>

				<div class="rrapp-iframe-limit-reached " @if ($hasLimitReached) show @else hidden @endif>
					<span class="rrapp-iframe-text rrapp-iframe-text_bold">Регистрация закрыта</span>
				</div>

				<div class="rrapp-iframe-form-content @if ($sentSuccessfully || $hasLimitReached) hidden @endif">
					<div class="rrapp-iframe-inputs-container">
						<div class="rrapp-iframe-element-container">
							<input name="name" value="{{old('name')}}" type="text" aria-label="Имя" class="rrapp-iframe-input-data rrapp-iframe-input @if($errors->has('name')) error @endif" placeholder="Имя *">
							@if($errors->has('name'))
								<label class="error">{{ $errors->first('name') }}</label>
							@endif
						</div>
						<div class="rrapp-iframe-element-container">
							<input name="email" value="{{old('email')}}" type="email" aria-label="Email" class="rrapp-iframe-input-data rrapp-iframe-input @if($errors->has('email')) error @endif" placeholder="E-mail *">
							@if($errors->has('email'))
								<label class="error">{{ $errors->first('email') }}</label>
							@endif
						</div>
						<div class="rrapp-iframe-element-container">
							<input id="phone" value="{{old('phone')}}" name="phone" aria-label="Телефон" class="rrapp-iframe-input-data rrapp-iframe-input @if($errors->has('phone')) error @endif" placeholder="Телефон *">
							@if($errors->has('phone'))
								<label class="error">{{ $errors->first('phone') }}</label>
							@endif
						</div>

						<div class="rrapp-iframe-element-container">
							<input id="tin" value="{{old('tin')}}" name="tin" type="text" aria-label="ИНН" class="rrapp-iframe-input-data rrapp-iframe-input @if($errors->has('tin')) error @endif" placeholder="ИНН *">
							@if($errors->has('tin'))
								<label class="error">{{ $errors->first('tin') }}</label>
							@endif
						</div>

					</div>
					<div class="rrapp-iframe-checkboxes-container">
						<label for="rrapp-iframe-radio-1" class="rrapp-iframe-checkbox-label">
							<div class="rrapp-iframe-checkbox-input--wrap">
								<input
										class="rrapp-iframe-input-data rrapp-iframe-checkbox-input"
										value="agree-personal"
										type="checkbox"
										name="personalData"
										id="rrapp-iframe-radio-1"
								>
							</div>

							<span class="rrapp-iframe-link-container">Я согласен на обработку
								<a class="rrapp-iframe-link"
								   target="_blank"
								   href="{{ route('page.show', ['slug' => constant("App\Enums\StaticPagesEnum::PRIVACY_POLICY_PAGE_SLUG")]) }}">
									 персональных данных
								</a>
								<span class="rrapp-iframe-star-icon">&lowast;</span>
							</span>
						</label>
						<span class="rrapp-iframe-form-message">* — поля, обязательные для заполнения</span>
					</div>
					<button type="submit" class="rrapp-iframe-button">
		            	<span>Регистрация</span>
					</button>
				</div>
			</form>
		</div>
	</section>
	<script
	  src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
	  integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="
	  crossorigin="anonymous">
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha256-Kg2zTcFO9LXOc7IwcBx1YeUBJmekycsnTsq2RuFHSZU=" crossorigin="anonymous">
	</script>
	<script>
		$(document).ready(function (){
			$('#phone').mask('+7(000)0000000');
			$('.rrapp-iframe-button')
				.attr('disabled', true)
				.addClass('rrapp-iframe-button-disabled-btn');

			function customCheckbox(){
			  var checkBox = $('.rrapp-iframe-checkbox-input');
				$(checkBox).each(function(){
						$(this).wrap( "<span class='rrapp-iframe-custom-checkbox'></span>" );
						if($(this).is(':checked')){
								$(this).parent().addClass("selected");
						}
				});
				$(checkBox).click(function(){
						$(this).parent().toggleClass("selected");
				});
			}
			customCheckbox();

			// Флаги инпутов по атрибутам, пустой/полный value
			let inputsValueFlags = {
				name: false,
				email: false,
				phone: false,
				personalData: false,
			};

			let rrappIframeForm = $('.rrapp-iframe-content__form');

			$('.rrapp-iframe-input-data').on('input', function(){
				$.each( inputsValueFlags, function( name ) {
					var value;
					if ('personalData' === name) {
						value = rrappIframeForm.find("input[name='" + name + "']").prop("checked")
					} else {
						value = rrappIframeForm.find("input[name='" + name + "']").val()
					}

					inputsValueFlags[name] = value ? true : false
				});

				if (inputsValueFlags['name'] &&
					inputsValueFlags['email'] &&
					inputsValueFlags['phone'] &&
					inputsValueFlags['personalData'])
				{
					$('.rrapp-iframe-button')
							.attr('disabled', false)
							.removeClass('rrapp-iframe-button-disabled-btn');
				} else {
					$('.rrapp-iframe-button')
							.attr('disabled', true)
							.addClass('rrapp-iframe-button-disabled-btn');
				}
			});
		})
	</script>
</body>
</html>




