@extends('/components/include')

<div class="popup" id="popup-feedback">
	<button class="popup-close" aria-label="Закрыть форму">
		<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M14 1.41L12.59 0L7 5.59L1.41 0L0 1.41L5.59 7L0 12.59L1.41 14L7 8.41L12.59 14L14 12.59L8.41 7L14 1.41Z" fill="black"/>
		</svg>
	</button>
	<form class="popup-form" id="popup-form" action="{{ route('application.create') }}">
		@csrf
		<input type="hidden" name="page_url" value="{{url()->current()}}">
		<input type="hidden" name="page_title" value="{{ $title }}">
		<h4 class="h4 popup__title">Задайте нам вопрос</h4>

		@auth
			<input type="hidden" name="full_name" aria-label="ФИО" class="input" placeholder="ФИО *" value="{{ auth()->user()->name }}">
			<input type="hidden" name="email" aria-label="E-mail" class="input" placeholder="E-mail *" value="{{ auth()->user()->email }}">
		@endauth

		@guest
			<div class="form-element-container">
				<input name="full_name" aria-label="ФИО" class="input" placeholder="ФИО *">
			</div>
			<div class="form-element-container">
				<input name="email" aria-label="E-mail" class="input" placeholder="E-mail *">
			</div>
		@endguest
		<div class="form-element-container">
			<input name="kind_of_activity" aria-label="Вид деятельности" class="input" placeholder="Вид деятельности *">
		</div>

		<div class="form-element-container form-element-container_text-area">
			<textarea name="content" class="textarea textarea_popup" placeholder="Текст сообщения *"></textarea>
		</div>
		<div class="checkboxes-container">
			<label for="radio-1" class="checkbox-label">
				<input
					class="checkbox-input"
					value="agree-personal"
					type="checkbox"
					name="personalData"
					id="radio-1"
				> Я согласен на обработку персональных данных*
			</label>
			<label for="radio-2" class="checkbox-label">
				<input
					class="checkbox-input"
					value="agree-rules"
					type="checkbox"
					name="siteRules"
					id="radio-2"
				>Я согласен с правилами пользования сайта*
			</label>

			<div id="recaptchaFeedback" class="recaptcha"></div>
		</div>
		<span class="form-message">* — поля, обязательные для заполнения</span>
		<button type="submit" class="button button_rounded button_big button_brown popup-submit-button"
			onclick="gtag('event','click',{'event_category':'submit2'}); ym(55128721,'reachGoal','message_success');"
		>
			<span class="text text_23 text_white text_PT-font">Отправить</span>
		</button>
	</form>
	<div class="popup-success">
		<p class="text text_28 text_brown text_solid popup-success__title">Ваша заявка отправлена</p>
		<p class="text text_19 text_solid text_PT-font">Специалист свяжется с вами в ближайшее время.</p>
	</div>
	<div class="popup-error">
		<p class="text text_28 text_brown text_solid popup-error__title">Что-то пошло не так</p>
		<p class="text text_19 text_solid text_PT-font">Попробуйте связаться с нами позже.</p>
	</div>
</div>

@push('scripts')
	<script src="/utils/js/jquery.modal.min.js"></script>
@endpush
