$(document).ready(function() {
	var $window = $(window);
	var activityDate = $('.activity-card__mouth');
	function checkWidth() {
		var windowsize = $window.width();
		if (windowsize > 550) {
			$.each(activityDate, function() {
				if (this.outerText.toLowerCase() === 'ноября') {
					this.innerHTML = this.outerText.substring(0, 4) + '.';
				} else if (this.outerText.length >= 5) {
					this.innerHTML = this.outerText.substring(0, 3) + '.';
				}
			});
		}
	}
	checkWidth();
	$(window).resize(checkWidth);
});
