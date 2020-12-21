$(document).ready(function () {
    if ($('.embeddedContent[data-resizetype="responsive"]').length > 0) {
        $('.embeddedContent[data-resizetype="responsive"]').each(function () {
            $(this).addClass('container-video');
            $(this).find('iframe').addClass('video');
        });
    }
});