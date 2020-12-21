<div id="popup-reset-password" class="popup">

	@if (session()->has('password_reset_token'))
		<form action="{{ route('password.update') }}" class="popup-form-reset-password form-popup form-popup_small"
			  id="popup-form-reset-password" method="post">
			@csrf

			<input type="hidden" name="token" value="{{ session()->get('password_reset_token') ?? null }}">

			<h4 class="h4 popup__title text_brown">Сброс пароля</h4>

			<div class="form-element-container">
				<input id="email" type="email" class="input" name="email" value="{{ session()->get('password_reset_email') ?? '' }}"
					   placeholder="E-mail" aria-label="E-mail">
			</div>

			<div class="form-element-container">
				<input id="password" type="password" class="input" name="password" value="{{ old('password') }}"
					   placeholder="Новый пароль">
			</div>

			<div class="form-element-container">
				<input id="password_confirmation" type="password" class="input" name="password_confirmation"
					   value="{{ old('password_confirmation') }}" placeholder="Повторите пароль">
			</div>

			<button type="submit"
					class="button button_rounded button_big button_brown popup-submit-button button_reset-password"
					id="button_reset-password">
				<span class="text text_23 text_white text_PT-font">Сбросить пароль</span>
			</button>

		</form>

	@endif

	<div class="popup-success-password-reset popup_small">
		<h4 class="h4 popup__title text_brown">{{ __('Reset password') }}</h4>
		<p class="text text_19 text_solid text_PT-font">{{ __('Reset password success') }}</p>
	</div>

	<div class="popup-error-password-reset popup_small">
		<h4 class="h4 popup__title text_brown">{{ __('Reset password') }}</h4>
		<p class="text text_19 text_solid text_PT-font">{{ __('Reset password error') }}</p>
	</div>

</div>
