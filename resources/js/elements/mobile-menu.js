$(document).ready(function() {
	var menu = $("nav.mobile-menu");
  var fade = $(".fade");

	$(".hamburger").on('click', function() {
		menu.addClass("menu-show");
    	fade.addClass("fade-show");
	});

	$(".button_close-mobile").on('click', function() {
		menu.removeClass("menu-show");
    fade.removeClass("fade-show");
	});

	$(document).mouseup(function(e)
	{
		if (!menu.is(e.target) && menu.has(e.target).length === 0) {
			menu.removeClass("menu-show");
      		fade.removeClass("fade-show");
		}
	});
});
