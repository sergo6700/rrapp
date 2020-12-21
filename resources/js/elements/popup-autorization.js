$(document).ready(function() {
	$('.button-show-popup-enter').on('click', function() {
		$('#popup-authorization').modal();
		$('#popup-authorization').modal({
			showClose: false,
			escapeClose: true,
			clickClose: false,
		});
		$('.popup-form-authorization').fadeIn();
		$('.popup-error').hide();
		$('.popup-form-forgot-password').hide();
		$('.popup-success-password').hide();

		return false;
	});

	$('.popup-close').on('click', function() {
		$.modal.close();
	});

	$('.button-password').click(function() {
		var input = $('.input_password-enter');
		if (input.attr('type') == 'password') {
			input.attr('type', 'text');
			$('.icon-eye-password').hide();
			$('.icon-eye-password_close').show();
		} else if (input.attr('type') == 'text') {
			input.attr('type', 'password');
			$('.icon-eye-password').show();
			$('.icon-eye-password_close').hide();
		}
	});

	$('.forgot-link').click(function(event) {
		event.preventDefault();
		$('.popup-form-authorization').hide();
		$('.popup-form-forgot-password').fadeIn(300);
	});

	$('#popup-form-authorization').on('submit', function(event) {
		let form = event.currentTarget;

		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
			},
			type: 'POST',
			data: $(form).serialize(),
			url: $(form).attr('action'),
			success: function() {
				window.location.reload();
			},
			error: function(error) {
				if (error.status === 422) {
					window.RemoveValidationErrors(form);
					let errors = error.responseJSON.errors;
					window.ShowFormValidationErrors(form, errors);
				} else {
					window.RemoveValidationErrors(form);
					$('.popup-form-authorization').fadeOut(300);
					$('.popup-error').fadeIn(300);
				}
			},
		});

		return false;
	});

	$('.popup-form-forgot-password').on('submit', function(event) {
		let form = event.currentTarget;

		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
			},
			type: 'POST',
			data: $(form).serialize(),
			url: $(form).attr('action'),
			success: function() {
				form.reset();
				$('.popup-form-authorization').hide();
				$('.popup-form-forgot-password').hide();
				$('.popup-success-password').fadeIn(300);
			},
			error: function(error) {
				if (error.status === 422) {
					window.RemoveValidationErrors(form);
					let errors = error.responseJSON.errors;
					window.ShowFormValidationErrors(form, errors);
				} else {
					window.RemoveValidationErrors(form);
					$('.popup-form-authorization').hide();
					$('.popup-form-forgot-password').hide();
					$('.popup-error').fadeIn(300);
				}
			},
		});

		return false;
	});

	// parse значения из confirm password в ссылку
	$('.button_reset-password').click(function() {
		var value = $('.input_confirm').val();
		var valueAttr = 'mailto:' + value;
		$('.link-forgot-parse').attr('href', valueAttr);
		$('.link-forgot-parse').text(value);
	});

	// переход на попап регистрации
	$('.popup-register-button').on('click', function() {
		$.modal.close();
		$('#popup-registration').modal({
			showClose: false,
			escapeClose: true,
			clickClose: false,
		});
		$('.popup-error').hide();
		$('.popup-form-authorization').hide();
		return false;
	});
});
