$(document).ready(function() {

    if ($('.service-form').length > 0 ) {
        let form = $('.service-form'),
            button = $('.service-form').find('button'),
            textarea = form.find('#content-field'),
            key = location.pathname;

        // pull text from localStorage and paste into text box
        if (!button.hasClass('button-show-popup-enter') && localStorage.getItem(key)) {
            textarea.val(
                localStorage.getItem(key)
            )

            localStorage.removeItem(key)
        }

        // save text to localStorage
        button.on('click', function (event) {
            if ($(event.target).hasClass('button-show-popup-enter')) {
                localStorage.setItem(key, textarea.val())
            }
        });
    }

});