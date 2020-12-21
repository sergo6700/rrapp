$(document).ready(function() {
	var toggleActivitiesButton = $('.button_toggle-activities');
	var currentActivities = $('.my-activities-current');
	var pastActivities = $('.my-activities-past');
	var activitiesContainer = $('.my-activities-slide');

	// Show past activities
	var convertToPastEvents = function() {
		currentActivities.fadeOut(300);
		pastActivities.delay(300).fadeIn(300);
		toggleActivitiesButton.html(
			'<span class=\'text text_17 text_bold text_PT-font text_black\'>Будущие мероприятия</span>'
		);
	};

	// Show current activities
	var convertToFutureEvents = function() {
		pastActivities.fadeOut(300);
		currentActivities.delay(300).fadeIn(300);
		toggleActivitiesButton.html(
			'<span class=\'text text_17 text_bold text_PT-font text_black\'>Прошедшие мероприятия</span>'
		);
	};

	toggleActivitiesButton.on('click', function() {
		activitiesContainer.toggleClass('active');
		if (activitiesContainer.hasClass('active')) {
			convertToPastEvents();
		} else {
			convertToFutureEvents();
		}
	});
});
