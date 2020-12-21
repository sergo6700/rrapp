$(document).ready(function() {

	var inoeText = $('#inn').val();
	checkInputVal($('#inn'));
	addDadata();
	var isNotChooseRole = $('#role').val() === '3';

	function checkInputVal(elem) {
		if (elem.length !== 0 && elem.val().length === 0) {
			$('.button_save-personal-info')
				.attr('disabled', true)
				.addClass('disabled-btn-brown');
		} else {
			$('.button_save-personal-info')
				.attr('disabled', false)
				.removeClass('disabled-btn-brown');
		}
	}

	function changeInput() {
		if (isNotChooseRole) {
            $('#custom-role-div').show();
		} else {
            $('#custom-role-div').hide();
            $('#custom-role').val('');
		}
	}

	function addDadata() {
		$('#inn').val(inoeText);
		$('#inn').suggestions({
			token: 'a2403f97592bea2c93dc851cf076c55657c96ce4',
			type: 'PARTY',
			/* Вызывается, когда пользователь выбирает одну из подсказок */
			onSelect: function(suggestion) {
				$('#inn').val(suggestion.data.inn);
				$('#organization').text(suggestion.value);
				$('#legal-adress').text(
					suggestion.data.address.unrestricted_value
				);
				$('#kpp').text(suggestion.data.kpp);
				$('#ogrn').text(suggestion.data.ogrn);
				$('#company_name_input').val(suggestion.value);
				$('#ogrn_input').val(suggestion.data.ogrn);
				$('#kpp_input').val(suggestion.data.kpp);
				$('#legal_address_input').val(
					suggestion.data.address.unrestricted_value
				);
			},
		});
	}

	function removeDadata() {
		$('#inn')
			.suggestions()
			.dispose();
	}

	changeInput();

	$('#inn').on('keyup', function() {
        $('#company_name_input').val('');
        $('#kpp_input').val('');
        $('#ogrn_input').val('');
        $('#legal_address_input').val('');
	});

	$('#role').change(function(e) {
		if (e.target.value === '3') {
			isNotChooseRole = true;
		} else {
			isNotChooseRole = false;
		}
		changeInput();
	});
});
