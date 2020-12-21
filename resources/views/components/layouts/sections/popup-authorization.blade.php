	<div class="popup" id="popup-authorization">
		<button class="popup-close" aria-label="Закрыть форму Входа">
			<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M14 1.41L12.59 0L7 5.59L1.41 0L0 1.41L5.59 7L0 12.59L1.41 14L7 8.41L12.59 14L14 12.59L8.41 7L14 1.41Z" fill="black"/>
			</svg>
		</button>

		<form action="{{ route('login') }}" class="popup-form-authorization form-popup form-popup_small" id="popup-form-authorization">
			@csrf

			<h4 class="h4 popup__title text_brown">Вход</h4>

			<div class="form-element-container">
                <input name="email" aria-label="E-mail" class="input" placeholder="E-mail">
			</div>

			<div class="form-element-container form-element-container_eye">
				<input type="password" name="password" aria-label="Пароль" class="input input_password-enter" placeholder="Пароль*">
				<button type="button" class="button button-password button_eye">
					<svg width="22" height="16" class="icon-eye-password" viewBox="0 0 22 16" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M11 0.5C6 0.5 1.73 3.61 0 8C1.73 12.39 6 15.5 11 15.5C16 15.5 20.27 12.39 22 8C20.27 3.61 16 0.5 11 0.5ZM11 13C8.24 13 6 10.76 6 8C6 5.24 8.24 3 11 3C13.76 3 16 5.24 16 8C16 10.76 13.76 13 11 13ZM11 5C9.34 5 8 6.34 8 8C8 9.66 9.34 11 11 11C12.66 11 14 9.66 14 8C14 6.34 12.66 5 11 5Z" fill="#808285"/>
					</svg>
					<svg width="23" height="20" class="icon-eye-password_close" viewBox="0 0 26 23" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M12.9993 5.16667C16.2194 5.16667 18.8327 7.78 18.8327 11C18.8327 11.7583 18.681 12.47 18.4127 13.135L21.8193 16.5417C23.581 15.0717 24.9694 13.17 25.821 11C23.8027 5.87833 18.821 2.25 12.9877 2.25C11.3543 2.25 9.79102 2.54167 8.34435 3.06667L10.8643 5.58667C11.5294 5.31833 12.241 5.16667 12.9993 5.16667ZM1.33268 1.98167L3.99268 4.64167L4.52935 5.17833C2.59268 6.68333 1.07602 8.69 0.166016 11C2.18435 16.1217 7.16602 19.75 12.9993 19.75C14.8077 19.75 16.5343 19.4 18.1093 18.77L18.5993 19.26L22.0177 22.6667L23.4994 21.185L2.81435 0.5L1.33268 1.98167ZM7.78435 8.43333L9.59268 10.2417C9.53435 10.4867 9.49935 10.7433 9.49935 11C9.49935 12.9367 11.0627 14.5 12.9993 14.5C13.256 14.5 13.5127 14.465 13.7577 14.4067L15.566 16.215C14.7843 16.6 13.921 16.8333 12.9993 16.8333C9.77935 16.8333 7.16602 14.22 7.16602 11C7.16602 10.0783 7.39935 9.215 7.78435 8.43333ZM12.8127 7.52333L16.4877 11.1983L16.511 11.0117C16.511 9.075 14.9477 7.51167 13.011 7.51167L12.8127 7.52333Z" fill="#808285"/>
					</svg>
				</button>
			</div>

			<a href="#" class="popup-form-authorization__link forgot-link text text_19 text_PT-font text_blue-light">Забыли пароль?</a>

			<button type="submit" class="button button_rounded button_big button_brown popup-submit-button">
            	<span class="text text_23 text_white text_PT-font">Войти</span>
			</button>
			<div class="ulogin-container ulogin-container_login">
				<div class="popup-devider popup-devider_login">
					<div class="popup-devider__line popup-devider__line_small"></div>
					<p class="popup-devider__text">или войти через</p>
					<div class="popup-devider__line popup-devider__line_small"></div>
				</div>

				<div id="uLogin-login" class="ulogin-buttons-container ulogin-buttons-container_login" data-ulogin="display=buttons;fields=first_name,last_name;
					redirect_uri={{ route('ulogin') }}">
					@include('components.layouts.includes.ulogin-registration-or-authorization')
				</div>
			</div>
			<button class="button button_small button_white button_rounded button_grey-border popup-register-button popup-register-button_login">
            	<span class="text text_23 text_black text_PT-font">Регистрация</span>
			</button>
		</form>

		<!-- forgot password -->
		<form action="{{ route('password.email') }}" class="popup-form-forgot-password  form-popup form-popup_small" id="popup-form-forgot-password">

			<h4 class="h4 popup__title text_brown">Восстановление пароля</h4>

			<span class="popup-form-forgot-password__text text text_19 text_PT-font">Введите свой e-mail, чтобы получить ссылку для сброса пароля</span>

			<div class="form-element-container">
                <input name="email" aria-label="E-mail" class="input input_confirm" placeholder="E-mail">
			</div>

			<button type="submit" class="button button_rounded button_big button_brown popup-submit-button button_reset-password">
            	<span class="text text_23 text_white text_PT-font">Сбросить пароль</span>
			</button>

		</form>
		<!-- forgot password -->

		<div class="popup-error">
			<p class="text text_28 text_brown text_solid popup-error__title">Что-то пошло не так</p>
			<p class="text text_19 text_solid text_PT-font">Попробуйте связаться с нами позже.</p>
		</div>

		<div class="popup-success-password popup_small">
			<h4 class="h4 popup__title text_brown">Восстановление пароля</h4>
			<p class="text text_19 text_solid text_PT-font">Ссылка для сброса пароля была отправлена вам на почту: <a href="mailto:web@2-up.ru" class="text text_19 text_PT-font text_blue-light link-forgot-parse">web@2-up.ru</a></p>
		</div>

		@include('components.layouts.sections.popup-reset-password')

	</div>
