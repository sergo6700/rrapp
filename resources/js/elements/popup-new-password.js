$(document).ready(function() {

	// инициализация popup-а
	$('#popup-new-password').modal({
		showClose: false
	});
	$('.popup-success_new-password').hide();
	$('.popup-error_new-password').hide();
	// инициализация popup-а


	$('#popup-form-new-password').on('submit', function(event) {
		let form = event.currentTarget;

		$.ajax({
			type: 'POST',
			data: $(form).serialize(),
			url: $(form.attr('action')),
			success: function() {
				form.reset();
				$('.popup-form-new-password').fadeOut(300);
				$('.popup-success').fadeIn(300);
			},
			error: function() {
				form.reset();
				$('.popup-form-new-password').fadeOut(300);
				$('.popup-error').fadeIn(300);
			},
		});
	});

});
