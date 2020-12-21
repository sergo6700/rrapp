var data = [
  {
	id: 0,
	text: '<div class="selected">01 - Растениеводство и животноводство, охота и предоставление соответствующих услуг в этих областях</div>',
	html: '<div class="custom-options">01 - Растениеводство и животноводство, охота и предоставление соответствующих услуг в этих областях <span class="options-info" data-id="0"></span></div>',
	info: '<span class="info-text">Антисептики, дезинфицирующе препараты, медицинские/гигиенические маски для лица, антибактериальные установки – обеззараживатели.</span>'
  }, 
  {
	id: 1,
	text: '<div class="selected">02 - Лесоводство и лесозаготовки</div>',
	html: '<div class="custom-options">02 - Лесоводство и лесозаготовки <span class="options-info" data-id="1"></span></div>',
	info: '<span class="info-text">Антисептики, дезинфицирующе препараты, медицинские/гигиенические маски для лица, антибактериальные установки – обеззараживатели.</span>'
  },
  {
	id: 2,
	text: '<div class="selected">03 - Рыболовство и рыбоводство</div>',
	html: '<div class="custom-options">03 - Рыболовство и рыбоводство <span class="options-info" data-id="2"></span></div>',
	info: '<span class="info-text">Антисептики, дезинфицирующе препараты, медицинские/гигиенические маски для лица, антибактериальные установки – обеззараживатели.</span>'
  },
  {
	id: 3,
	text: '<div class="selected">01 - Растениеводство и животноводство, охота и предоставление соответствующих услуг в этих областях</div>',
	html: '<div class="custom-options">01 - Растениеводство и животноводство, охота и предоставление соответствующих услуг в этих областях <span class="options-info" data-id="0"></span></div>',
	info: '<span class="info-text">Антисептики, дезинфицирующе препараты, медицинские/гигиенические маски для лица, антибактериальные установки – обеззараживатели.</span>'
  }, 
  {
	id: 4,
	text: '<div class="selected">02 - Лесоводство и лесозаготовки</div>',
	html: '<div class="custom-options">02 - Лесоводство и лесозаготовки <span class="options-info" data-id="1"></span></div>',
	info: '<span class="info-text">Антисептики, дезинфицирующе препараты, медицинские/гигиенические маски для лица, антибактериальные установки – обеззараживатели.</span>'
  },
  {
	id: 5,
	text: '<div class="selected">03 - Рыболовство и рыбоводство</div>',
	html: '<div class="custom-options">03 - Рыболовство и рыбоводство <span class="options-info" data-id="2"></span></div>',
	info: '<span class="info-text">Антисептики, дезинфицирующе препараты, медицинские/гигиенические маски для лица, антибактериальные установки – обеззараживатели.</span>'
  },
];

//   <option value="01">01 - Растениеводство и животноводство, охота и предоставление соответствующих услуг в этих областях</option>
//   <option value="02">02 - Лесоводство и лесозаготовки</option>
//   <option value="03">03 - Рыболовство и рыбоводство</option>
//   <option value="05">05 - Добыча угля</option>

$(document).ready(function() {
	// var popup = $('.popup');
	var selectValue = '';
	var popupError = $('.popup-select-error');

	$('.popup-select').select2({
		minimumResultsForSearch: Infinity,
		selectOnClose: true,
	});
	$('.select-simple').select2({
		minimumResultsForSearch: Infinity,
		selectOnClose: true,
		width: '',
	  });
	  $('.select-okveds').select2({
		minimumResultsForSearch: Infinity,
		selectOnClose: true,
		width: '',
		data: data,
		templateResult: function (d) { return $(d.html); },
		templateSelection: function (d) { return $(d.text); }
	  }).on("select2:open", function (e) { 
		  setTimeout(() => {
			$('.options-info').hover(
				function() {
				  showInfo(this)
				}, function() {
				  removeInfo(this)
				}
			  );
		  }, 0);
		  
		});

		function showInfo(el) {
		  const id = $(el).attr('data-id')
		  const top = el.getBoundingClientRect().top
		  const left = el.getBoundingClientRect().left
		  const info = data[id].info
		  $( "body" ).append(info)
		  $('.info-text').css({ top: top - 15 + 'px', left: left + 60 + 'px'});
		}
		function removeInfo(el) {
			$( ".info-text" ).remove();
		  }
	
	$('.show-popup-button').on('click', function(event) {
		$('#popup-feedback').modal({
			showClose: false,
			escapeClose: true,
			clickClose: false,
		});
		$('.popup-form').fadeIn();
		$('.popup-success').fadeOut();
		$('.popup-error').fadeOut();
		$('.custom-checkbox').removeClass('selected');

		window.RemoveValidationErrors('.popup-form');

		let subject_id = $(event.currentTarget).data('subject_id') || null;
		$('.popup-form')
			.find('[name=subject]')
			.val(subject_id)
			.trigger('change');
	});

	$('.popup-close').on('click', function() {
		$.modal.close();
	});

	$('#popup-form').on('submit', function(event) {
		let form = event.currentTarget;

		$.ajax({
			type: 'POST',
			data: $(form).serialize(),
			url: $(form).attr('action'),
			success: function() {
				form.reset();
				$('.popup-form').fadeOut(300);
				$('.popup-success').fadeIn(300);
			},
			error: function(error) {
				if (error.status === 422) {
					window.RemoveValidationErrors(form);

                    if (widgetRecaptchaFeedback !== undefined || widgetRecaptchaFeedback !== null) {
                        grecaptcha.reset(widgetRecaptchaFeedback);
                    }
                    
					let errors = error.responseJSON.errors;
					window.ShowFormValidationErrors(form, errors);
				} else {
					window.RemoveValidationErrors(form);
					$('.popup-form-authorization').hide();
					$('.popup-form-forgot-password').hide();
					$(form).hide();
					$('.popup-error').fadeIn(300);
				}
			},
		});

		return false;
	});

	if ($('#popup-success-show').length) {
		$('.popup-form').hide();
		$('.popup-success').show();
		$('.popup-error').hide();
		$('#popup-feedback').modal({
			showClose: false,
			escapeClose: true,
			clickClose: false,
		});
	}
});
