@extends('/components/include')
	<div class="popup" id="popup-registration-step-2">
		<form action="{{ route('register.profile.update') }}" class="popup-form-registration form-popup form-popup_small" id="popup-form-registration-step2">
			<h4 class="h4 popup__title popup__title_registration text_brown">Регистрация</h4>
			<div class="form-element-container">
                <input name="email" aria-label="E-mail" class="input" placeholder="E-mail *">
			</div>
			<div class="form-element-container form-element-container_select">
				<select name="role_in_company_id" class="popup-select" id="role_in_company_id-step2" aria-label="Выберите роль">
					<option value="" selected hidden disabled>Роль *</option>
					@foreach ($user_roles as $role_id => $role)
						<option value="{{ $role_id }}"
							{{ ($info->role_in_company_id ?? null) === $role_id ? 'selected' : '' }}>
							{{ $role['name'] }}
						</option>
					@endforeach
				</select>
			</div>
			<div class="form-element-container js-inn">
                <input type="number" name="tin" id="inn-step2" aria-label="ИНН" class="input" placeholder="ИНН *">
			</div>
			<div class="checkboxes-container">
				<label for="radio-1-registration-step2" class="checkbox-label">
					<input
						class="checkbox-input"
						value="agree-personal"
						type="checkbox"
						name="personalData"
						id="radio-1-registration-step2"
					> Я согласен на обработку персональных данных*
				</label>
				<label for="radio-2-registration-step2" class="checkbox-label">
					<input
						class="checkbox-input"
						value="agree-rules"
						type="checkbox"
						name="siteRules"
						id="radio-2-registration-step2"
					>Я согласен с правилами пользования сайта*
				</label>
			</div>

			<div class="form-group row">
			    <input id="legal_address-step2" type="text" class="hidden-inputs" name="legal_address">
			    <input id="kpp-step2" type="text" class="hidden-inputs" name="kpp">
			    <input id="ogrn-step2" type="text" class="hidden-inputs" name="ogrn">
				<input id="company_name-step2" type="text" class="hidden-inputs" name="company_name">
			</div>
			<span class="form-message">* — поля, обязательные для заполнения</span>

			<button type="submit" class="button button_rounded button_big button_brown popup-submit-button">
            	<span class="text text_23 text_white text_PT-font">Регистрация</span>
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
