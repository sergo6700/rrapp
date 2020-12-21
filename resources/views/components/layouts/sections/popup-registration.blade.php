@extends('/components/include')

	<div class="popup" id="popup-registration">
		<button class="popup-close" aria-label="Закрыть форму Регистрации">
			<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M14 1.41L12.59 0L7 5.59L1.41 0L0 1.41L5.59 7L0 12.59L1.41 14L7 8.41L12.59 14L14 12.59L8.41 7L14 1.41Z" fill="black"/>
			</svg>
		</button>
		<form action="{{ route('register') }}" class="popup-form-registration form-popup form-popup_small" id="popup-form-registration">
			<h4 class="h4 popup__title popup__title_registration text_brown">Регистрация</h4>
			<div class="ulogin-container">
				<div class="uLogin-title-container">
					<p class="uLogin-title text text_19">Зарегистрироваться через</p>
				</div>

				<div id="uLogin" class="ulogin-buttons-container" data-ulogin="display=buttons;fields=first_name,last_name;
					redirect_uri={{ route('ulogin') }};mobilebuttons=0;">
					@include('components.layouts.includes.ulogin-registration-or-authorization')
				</div>

				<div class="popup-devider">
					<div class="popup-devider__line"></div>
					<p class="popup-devider__text">или</p>
					<div class="popup-devider__line"></div>
				</div>
			</div>
			<div class="form-element-container">
                <input name="name" aria-label="ФИО" class="input" placeholder="ФИО *">
			</div>
			<div class="form-element-container">
                <input name="email" aria-label="E-mail" class="input" placeholder="E-mail *">
			</div>
			<div class="form-element-container form-element-container__phone-prefix">
                <input name="phone" aria-label="Телефон" class="input" placeholder="(___) ___ __ __ *" id="phone">
			</div>

			<div class="form-element-container form-element-container_select">
				<select name="role_in_company_id" class="popup-select" id="role_in_company_id">
					<option value="" selected hidden disabled>Роль *</option>
					@foreach ($user_roles as $role_id => $role)
						<option value="{{ $role_id }}"
							{{ ($info->role_in_company_id ?? null) === $role_id ? 'selected' : '' }}>
							{{ $role['name'] }}
						</option>
					@endforeach
				</select>
			</div>

			<div class="form-element-container js-tin">
                <input type="number" name="tin" id="tin" aria-label="ИНН" class="input" placeholder="ИНН *">
			</div>

			<div class="form-element-container js-custom-role">
                <input type="text" name="custom_role" id="custom-role" aria-label="" class="input" placeholder="Укажите роль">
			</div>

			<div class="form-element-container js-company_name">
                <input name="company_name" id="company_name" aria-label="Организация" class="input" placeholder="Организация *">
			</div>

			<div class="form-element-container form-element-container_eye">
				<input type="password" name="password" aria-label="Пароль" class="input input_password" placeholder="Пароль *">
				<button type="button" class="button button-visible-password button_eye">
					<svg width="22" height="16" class="icon-eye" viewBox="0 0 22 16" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M11 0.5C6 0.5 1.73 3.61 0 8C1.73 12.39 6 15.5 11 15.5C16 15.5 20.27 12.39 22 8C20.27 3.61 16 0.5 11 0.5ZM11 13C8.24 13 6 10.76 6 8C6 5.24 8.24 3 11 3C13.76 3 16 5.24 16 8C16 10.76 13.76 13 11 13ZM11 5C9.34 5 8 6.34 8 8C8 9.66 9.34 11 11 11C12.66 11 14 9.66 14 8C14 6.34 12.66 5 11 5Z" fill="#808285"/>
					</svg>
					<svg width="23" height="20" class="icon-eye_close" viewBox="0 0 26 23" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M12.9993 5.16667C16.2194 5.16667 18.8327 7.78 18.8327 11C18.8327 11.7583 18.681 12.47 18.4127 13.135L21.8193 16.5417C23.581 15.0717 24.9694 13.17 25.821 11C23.8027 5.87833 18.821 2.25 12.9877 2.25C11.3543 2.25 9.79102 2.54167 8.34435 3.06667L10.8643 5.58667C11.5294 5.31833 12.241 5.16667 12.9993 5.16667ZM1.33268 1.98167L3.99268 4.64167L4.52935 5.17833C2.59268 6.68333 1.07602 8.69 0.166016 11C2.18435 16.1217 7.16602 19.75 12.9993 19.75C14.8077 19.75 16.5343 19.4 18.1093 18.77L18.5993 19.26L22.0177 22.6667L23.4994 21.185L2.81435 0.5L1.33268 1.98167ZM7.78435 8.43333L9.59268 10.2417C9.53435 10.4867 9.49935 10.7433 9.49935 11C9.49935 12.9367 11.0627 14.5 12.9993 14.5C13.256 14.5 13.5127 14.465 13.7577 14.4067L15.566 16.215C14.7843 16.6 13.921 16.8333 12.9993 16.8333C9.77935 16.8333 7.16602 14.22 7.16602 11C7.16602 10.0783 7.39935 9.215 7.78435 8.43333ZM12.8127 7.52333L16.4877 11.1983L16.511 11.0117C16.511 9.075 14.9477 7.51167 13.011 7.51167L12.8127 7.52333Z" fill="#808285"/>
					</svg>
				</button>
			</div>

			<div class="form-element-container">
                <input type="password" name="password_confirmation" aria-label="Подтверждение пароля" class="input input_password" placeholder="Подтвердите пароль *">
			</div>

			<div class="checkboxes-container">
				<label for="radio-1-registration" class="checkbox-label">
					<input
							class="checkbox-input"
							value="agree-personal"
							type="checkbox"
							name="personalData"
							id="radio-1-registration"
					> Я согласен на обработку персональных данных*
				</label>
				<label for="radio-2-registration" class="checkbox-label">
					<input
							class="checkbox-input"
							value="agree-rules"
							type="checkbox"
							name="siteRules"
							id="radio-2-registration"
					>Я согласен с правилами пользования сайта*
				</label>
			</div>

			<div class="form-group row">
			    <input id="legal_address" type="text" class="hidden-inputs" name="legal_address">
			    <input id="kpp" type="text" class="hidden-inputs" name="kpp">
			    <input id="ogrn" type="text" class="hidden-inputs" name="ogrn">
			</div>

			<div class="recaptcha recaptcha_resgistration" id="recaptchaResgistration"></div>
			<span class="form-message">* — поля, обязательные для заполнения</span>

			<button type="submit" class="button button_rounded button_big button_brown popup-submit-button"
				onclick="gtag('event','click',{'event_category':'registration'}); ym(55128721,'reachGoal','registration');"
			>
            	<span class="text text_23 text_white text_PT-font">Регистрация</span>
			</button>
			<button class="button button_small button_white button_rounded button_grey-border popup-enter-button">
            	<span class="text text_23 text_black text_PT-font">Вход</span>
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

@include('components.layouts.sections.popup-registration-error')
