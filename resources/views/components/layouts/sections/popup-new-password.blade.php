@extends('/components/include')

	<div class="popup" id="popup-new-password">

		<button class="popup-close" aria-label="Закрыть форму">
			<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M14 1.41L12.59 0L7 5.59L1.41 0L0 1.41L5.59 7L0 12.59L1.41 14L7 8.41L12.59 14L14 12.59L8.41 7L14 1.41Z" fill="black"/>
			</svg>
		</button>

		<form action="{{ route('password.update') }}" class="popup-form-new-password form-popup form-popup_small" id="popup-form-new-password">

			<input type="hidden">

			<h4 class="h4 popup__title text_brown">Придумайте новый пароль</h4>

			<div class="form-element-container form-element-container_eye">
				<input type="password" name="new_password" aria-label="Пароль" class="input input_password" placeholder="Пароль*">
				<button type="button" class="button button-visible-password button_eye">
					<svg width="22" height="16" class="icon-eye" viewBox="0 0 22 16" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M11 0.5C6 0.5 1.73 3.61 0 8C1.73 12.39 6 15.5 11 15.5C16 15.5 20.27 12.39 22 8C20.27 3.61 16 0.5 11 0.5ZM11 13C8.24 13 6 10.76 6 8C6 5.24 8.24 3 11 3C13.76 3 16 5.24 16 8C16 10.76 13.76 13 11 13ZM11 5C9.34 5 8 6.34 8 8C8 9.66 9.34 11 11 11C12.66 11 14 9.66 14 8C14 6.34 12.66 5 11 5Z" fill="#808285"/>
					</svg>
				</button>
			</div>

			<div class="form-element-container">
                <input type="password" name="new_confirmPassword" aria-label="Подтверждение пароля" class="input input_password" placeholder="Подтвердите пароль">
			</div>

			<button type="submit" class="button button_rounded button_big button_brown popup-submit-button">
            	<span class="text text_23 text_white text_PT-font">Сохранить</span>
			</button>

		</form>

		<div class="popup-success popup-success_new-password">
			<p class="text text_28 text_brown text_solid popup-success__title">Пароль успешно изменен</p>
		</div>

		<div class="popup-error popup-error_new-password">
			<p class="text text_28 text_brown text_solid popup-error__title">Что-то пошло не так</p>
			<p class="text text_19 text_solid text_PT-font">Попробуйте связаться с нами позже.</p>
		</div>

	</div>

<!-- here -->

@push('scripts')
    <script src="/utils/js/jquery.validate.min.js"></script>
	<script src="/utils/js/additional-methods.min.js"></script>
@endpush
