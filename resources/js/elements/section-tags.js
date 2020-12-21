$(document).ready(function() {
	let visible_block_max_height = 44;

	$('.hashtag-block__visible').map(function () {
		if ($(this).height() > visible_block_max_height) {
			$(this).next().show();
		}
	});

	$('.hashtag-block__link').each(function () {
		let tags_block = $(this).prev().find('.hashtag-block__inner');

		if (tags_block.hasClass('show_all')) {
			$(this).find('span').text('Скрыть');
		} else {
			$(this).find('span').text('Показать все');
		}
	});

	$('.hashtag-block__link').on('click', function (event) {
		let tags_block = $(event.currentTarget).prev().find('.hashtag-block__inner');

		tags_block.toggleClass('show_all');

		if (tags_block.hasClass('show_all')) {
			$(event.currentTarget).text('Скрыть');
		} else {
			$(event.currentTarget).text('Показать все');
		}

		return false;
	});

	/**
	 * Если в адресной строке раздела "Сервисы" есть строка запроса вида '?tags...', то
	 * мы открываем список всех тегов по той причине, что некоторые теги могут быть не видны пользователю
	 * и находится в свёрнутом виде.
	 */
	if (location.search.indexOf('tags') !== -1 && $('.button-tag').length > 0) {
		$('.button-tag').click();
	}
});
