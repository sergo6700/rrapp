
$(document).ready(function() {
	var filterModal = $(".filter-dropdown");
	$(".button_filter").on('click', function() {
		filterModal.fadeIn(200);
	});
	$(".button_close").on('click', function() {
		filterModal.fadeOut(200);
	});

	/**
	 * если есть хотя бы один активный параметр в форме "Фильтр",
	 * то мы делаем активной кнопку, вызывающую модальное окно с фильтром
 	 */
	if ($('.filter-dropdown__form').length > 0 && $('.filter-dropdown__form').serialize()) {
		$(".button_filter").addClass('active');
	}
});
