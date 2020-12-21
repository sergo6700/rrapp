var headerIndent;
if ($(window).width() > 550) {
	headerIndent = 100;
} else {
	headerIndent = 20;
}
$(window).on('scroll', function() {
	if ($(window).scrollTop() > headerIndent) {
		$('.header').addClass('header_active');
	} else {
		$('.header').removeClass('header_active');
	}
});
