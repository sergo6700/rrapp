$(document).ready(function() {
	$('#role').select2({
		minimumResultsForSearch: Infinity,
		selectOnClose: true
	});

	$('#role').change(function() {
		var placeholder_list = {
				1: {
					tin: 'ИНН',
					type: 'number'
				},
				2: {
					tin: 'ИНН',
					type: 'number'
				},
				3: {
					tin: 'Укажите роль',
					type: 'text'
				}
			},
			selectedValue = $( this ).val(),
			placeholder = null;

		if (placeholder = placeholder_list[selectedValue]) {
			$('#inn').attr('type', placeholder.type);
			$('#inn').attr('placeholder', placeholder.tin);
		}
	});

});