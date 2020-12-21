$(document).ready(function() {
	showSecondRegistrationPopup();

	var isRoleNotSelected = true;
	// Скрываем поля Инн и Организация если роль не выбрана
	if ($('#role').val() === undefined) {
		$('.js-custom-role').hide();
		isRoleNotSelected = true;
	} else {
		$('.js-custom-role').show();
		isRoleNotSelected = false;
	}

	addDadata();

	$('.button-show-popup-registration').on('click', function() {
		$('#popup-registration-error').modal();
		$('#popup-registration').modal({
			showClose: false,
			escapeClose: true,
			clickClose: false,
		});

		$('.popup-form-registration').fadeIn();
		$('.popup-success').fadeOut();
		$('.popup-error').fadeOut();
		$('.custom-checkbox').removeClass('selected');
	});

	// форма регистрации
	if ($('#phone').length > 0) {
		$('#phone').mask('(000)000 00 00');
	}

	// Личный кабинет
	if ($('#personal-phone').length > 0) {
		$('#personal-phone').mask('+7(000)0000000');
	}

	$('.popup-close').on('click', function() {
		$.modal.close();
	});

	$('.button-visible-password').click(function() {
		var inputs = $('.input_password');

		if (inputs.attr('type') == 'password') {
			inputs.attr('type', 'text');

			$('.icon-eye').hide();
			$('.icon-eye_close').show();
		} else if (inputs.attr('type') == 'text') {
			inputs.attr('type', 'password');

			$('.icon-eye').show();
			$('.icon-eye_close').hide();
		}
	});

	// Submit form
	$('#popup-form-registration').on('submit', function(event) {
		let form = event.currentTarget;
		let data = $(form).serialize();
		$.ajax({
			headers: {
				Accept: 'application/json',
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
			},
			type: 'POST',
			data: data,
			cache: false,
			url: $(form).attr('action'),
			success: function() {
				window.location.reload();
			},
			error: function(error) {
				if (error.status === 422) {
					window.RemoveValidationErrors(form);

					if (
						widgetRecaptchaResgistration !== undefined ||
						widgetRecaptchaResgistration !== null
					) {
						grecaptcha.reset(widgetRecaptchaResgistration);
					}

					let errors = error.responseJSON.errors;
					window.ShowFormValidationErrors(form, errors);
				} else {
					window.RemoveValidationErrors(form);
					$('#popup-form-registration').fadeOut(300);
					$('.popup-error').fadeIn(300);
				}
			},
		});

		return false;
	});

	// переход на попап авторизации
	$('.popup-enter-button').on('click', function() {
		$.modal.close();
		$('#popup-authorization').modal({
			showClose: false,
			escapeClose: true,
			clickClose: false,
		});
		$('.popup-error').hide();
		$('.popup-form-forgot-password').hide();
		$('.popup-success-password').hide();
		$('.popup-form-authorization').show();
		return false;
	});

	// переключение placeholder для полей "ИНН" и "Организация", в зависимости от выбранной роли
	$('#role_in_company_id').change(function(e) {
		isRoleNotSelected = false;
		if (e.target.value === '3') {
			if (!isRoleNotSelected && $('#role').val() === undefined) {
                $('.js-custom-role').show();
			} else {
				$('.js-custom-role').hide();
			}
		} else {
			$('.js-custom-role').hide();
		}
	});

	const QUERY_PARAM_FOR_CALL_ERROR_POPUP = '?popup=registration-error';
	if (
		window.location.search.indexOf(QUERY_PARAM_FOR_CALL_ERROR_POPUP) != -1 &&
		$('#popup-registration-error').length > 0
	) {
		$('#popup-registration-error').modal({
			showClose: true,
			escapeClose: true,
			clickClose: true,
		});
	}

	$('#tin').on('keyup', function() {
		$('#company_name').addClass('disabled-input');
	});

	// Подключение dadata к полю ИНН
	function addDadata() {
		$('#tin').suggestions({
			token: 'a2403f97592bea2c93dc851cf076c55657c96ce4',
			type: 'PARTY',
			/* Вызывается, когда пользователь выбирает одну из подсказок */
			onSelect: function(suggestion) {
				$('#tin').val(suggestion.data.inn);
				$('#company_name').val(suggestion.value);
				$('#ogrn').val(suggestion.data.ogrn);
				$('#kpp').val(suggestion.data.kpp);
				$('#legal_address').val(suggestion.data.address.value);
			},
		});
	}

	// Вызов второго шага регистрации
	function showSecondRegistrationPopup() {
		var pageUrl = window.location.href;
		if (pageUrl.includes('popup=registration-step-2')) {
			$('#popup-registration-step-2').modal({
				showClose: false,
				escapeClose: false,
				clickClose: false,
			});
		}
	}
});
