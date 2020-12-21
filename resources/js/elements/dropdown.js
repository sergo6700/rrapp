$(document).ready(function() {
	var $dropdown = $('.header-dropdown');
	$('.lk-button').on('click', function() {
		$dropdown.addClass('header-dropdown_active');
	});
	$(document).mouseup((e) => {
		if (!$dropdown.is(e.target) && $dropdown.has(e.target).length === 0) {
			$dropdown.removeClass('header-dropdown_active');
		}
	});
});
