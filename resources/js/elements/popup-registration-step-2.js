$(document).ready(function() {
	addDadata();
	var isRoleNotSelected = true;

	// Скрываем поля Инн и Организация если роль не выбрана
	if ($('#role_in_company_id-step2').val() === null) {
		$('.js-inn').hide();
		isRoleNotSelected = true;
	} else {
		$('.js-inn').show();
		isRoleNotSelected = false;
	}

	// Подключение dadata к полю ИНН
	function addDadata() {
		$('#inn-step2').suggestions({
			token: 'a2403f97592bea2c93dc851cf076c55657c96ce4',
			type: 'PARTY',
			/* Вызывается, когда пользователь выбирает одну из подсказок */
			onSelect: function(suggestion) {
				$('#inn-step2').val(suggestion.data.inn);
				$('#company_name-step2').val(suggestion.value);
				$('#ogrn-step2').val(suggestion.data.ogrn);
				$('#kpp-step2').val(suggestion.data.kpp);
				$('#legal_address-step2').val(suggestion.data.address.value);
			},
		});
	}

	// переключение placeholder для полей "ИНН" и "Организация", в зависимости от выбранной роли
	$('#role_in_company_id-step2').change(function(e) {
		isRoleNotSelected = false;
		$('.js-inn').show();
		if (e.target.value === '3') {
			if (!isRoleNotSelected) {
				$('#inn-step2')
					.suggestions()
					.dispose();
				$('#inn-step2').val('');
				$('#inn-step2')
					.val('')
					.attr('placeholder', 'Укажите роль *');
				$('#ogrn-step2').val('');
				$('#kpp-step2').val('');
				$('#legal_address-step2').val('');
				$('#inn-step2').attr('placeholder', 'Укажите роль *');
				$('#inn-step2').attr('type', 'text');
			}
		} else {
			$('#inn-step2').val('');
			addDadata();
			$('#company_name-step2').val('');
			$('#inn-step2').attr('type', 'number');
			$('#inn-step2').attr('placeholder', 'ИНН *');
		}
	});

	// Submit form
	$('#popup-form-registration-step2').on('submit', function(event) {
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
				var currentLocation = window.location;
				var locationAfterRedirect = currentLocation.href.replace(
					'?popup=registration-step-2',
					''
				);
				window.location.replace(locationAfterRedirect);
			},
			error: function(error) {
				if (error.status === 422) {
					window.RemoveValidationErrors(form);
					let errors = error.responseJSON.errors;
					window.ShowFormValidationErrors(form, errors);
				} else {
					window.RemoveValidationErrors(form);
					$('#popup-form-registration-step2').fadeOut(300);
					$('.popup-error').fadeIn(300);
				}
			},
		});

		return false;
	});
});
