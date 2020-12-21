$(document).ready(function() {
	var tagSection = $('.section-tags_height');
	var buttonTag = $('.button-tag');
	var btnIcon = $('.button-tag__icon');
	var currentHeight = tagSection.css('height');
	var jsTagItems = $('.js-tag-item');
	var serviceTags = $('.js-services-card');
	var tagsSelected = [];

	buttonTag.click(function() {
		if (tagSection.attr('data-open') === 'false') {
			var tagContainerHeight = $('.section-tags__container').height();
			tagSection.css('max-height', tagContainerHeight);
			tagSection.attr('data-open', 'true');
			btnIcon.toggleClass('button-tag__icon_open');
		} else {
			tagSection.css('max-height', currentHeight);
			tagSection.attr('data-open', 'false');
			btnIcon.toggleClass('button-tag__icon_open');
		}
	});

	jsTagItems.each(function() {
		// если при загрузке страницы уже есть выбранный тег,
		// то добавляем его в массив tagsSelected
		if ($(this).hasClass('block-tag__link_active')) {
			tagsSelected.push($(this).data('tag'));
		}

		$(this).on('click', function() {
			if ($(this).hasClass('block-tag__link_active')) {
				$(this).removeClass('block-tag__link_active');
				var currentTag = $(this).data('tag');
				tagsSelected = $.grep(tagsSelected, function(value) {
					return value !== currentTag;
				});
				if (tagsSelected.length < 1) {
					showAllServiceCard();
				}
				selectServiceByTag(tagsSelected);
			} else {
				$(this).addClass('block-tag__link_active');
				tagsSelected.push($(this).data('tag'));
				selectServiceByTag(tagsSelected);
			}

			$.ajax({
				type: 'POST',
				data: {
					_token: $('#csrf-token')[0].content,
					tags: tagsSelected,
				},
				url: '/service/tags/filter',
				success: function(data) {

					$('#container-services')
						.find('.services-container')
						.remove();
					$('#container-services')
						.find('.pagination')
						.remove();
					$('#container-services')
						.find('.section-tags')
						.after(data);
				},
			});
		});
	});

	function selectServiceByTag(tagsSelectedArray) {
		serviceTags.each(function() {
			var currentCard = $(this);
			var curentCardTags = $(this)
				.data('tag')
				.split(',');
			tagsSelectedArray.forEach(function(element) {
				if ($.inArray(element, curentCardTags) === -1) {
					currentCard.addClass('services-card_hidden');
				} else currentCard.removeClass('services-card_hidden');
			});
		});
	}

	function showAllServiceCard() {
		serviceTags.each(function() {
			$(this).removeClass('services-card_hidden');
		});
	}
});
