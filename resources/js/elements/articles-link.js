$(document).ready(function (){
    $('.articles-block, .articles-card').on('click', function () {
        var link = $(this).find('a[href]').attr('href');

        if (link) {
            window.location.href = link;
        }
    });
})