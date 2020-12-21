/**
 * Set fields in form to null
 */
$(document).ready(function() {
	$('button[type=reset].reset-form').on('click', function (event) {
		$(event.currentTarget).parents('form')
			.find('[name]')
			.each(function (key, item) {
				var $this = $(item);

				switch ($this.attr('type')) {
					case 'checkbox':
						if ( $this.prop('checked') ) {
							$this.prop('checked', false);
							$this.parent('.custom-checkbox').removeClass('selected')
						}
					default:
						$this.val(null).trigger('change');
				}
			});

		return false;
	});
});
