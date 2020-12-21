$(document).ready(function() {
	if ($('#popup-form-reset-password').length) {
		$('#popup-reset-password').modal({
			showClose: false,
			escapeClose: true,
			clickClose: false,
		});
		$('.popup-success-password-reset').hide();
		$('.popup-error-password-reset').hide();
		$('#popup-form-reset-password').fadeIn(300);

		$('#popup-form-reset-password').on('submit', function(event) {
			var form = event.currentTarget;

			$.ajax({
				type: 'POST',
				data: $(form).serialize(),
				url: $(form).attr('action'),
				success: function(response) {
					if (response.error) {
						$('#popup-form-reset-password').hide();
						$('.popup-error-password-reset').fadeIn(300);
					} else {
						$('#popup-form-reset-password').hide();
						$('.popup-success-password-reset').fadeIn(300);
					}
				},
				error: function(error) {
					if (error.status === 422) {
						window.RemoveValidationErrors(form);
						let errors = error.responseJSON.errors;
						window.ShowFormValidationErrors(form, errors);
					} else {
						window.RemoveValidationErrors(form);
						$(form).hide();
						$('.popup-error-password-reset').fadeIn(300);
					}
				},
			});

			return false;
		});
	}
});
