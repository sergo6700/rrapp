/**
 * Form label element with error for field
 *
 * @param field
 * @param error
 * @returns {HTMLElement}
 * @constructor
 */
function FormLabelForField(field, error)
{
	let label = document.createElement('label');
	label.setAttribute('id', field + '-error');
	label.setAttribute('for', field);
	label.setAttribute('class', 'error');
	label.innerText = error;

	return label;
}

/**
 * Shows validation errors on form
 *
 * @param form
 * @param errors
 * @constructor
 */
window.ShowFormValidationErrors = function(form, errors)
{
	for (let field in errors) {
		let item = $(form).find('[name=' + field + ']');

		item.attr('area-invalid', true)
			.addClass('error');

		if (item[0].nodeName === 'SELECT') {
			item.next().find('.select2-selection').addClass('select-error-border');
		}

		if (errors[field][0]) {
			let label = FormLabelForField(field, errors[field][0]);
			item.parent().append(label);
		}
	}
};

/**
 * Remove validation errors
 *
 * @param form
 * @constructor
 */
window.RemoveValidationErrors = function (form)
{
	$(form).find('[name][type!=hidden]').each(function (index, element) {
		$(element).attr('area-invalid', false).removeClass('error');

		if (element.nodeName === 'SELECT') {
			$(element).next().find('.select2-selection').removeClass('select-error-border');
		}

		$(element).parent().find('label.error').remove();
	});
};
