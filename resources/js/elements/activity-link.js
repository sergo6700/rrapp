$(document).ready(function (){
    $('.activity-card').on('click', function () {
        var link = $(this).find('a[href]').attr('href');

        if (link) {
            window.location.href = link;
        }
    });
})
