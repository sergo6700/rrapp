$(document).ready(function() {
    const QUERY_PARAM_THAT_CAUSES_POPUP = 'confirmed';

    if (window.location.search.indexOf(QUERY_PARAM_THAT_CAUSES_POPUP) != -1
        && $('#popup-your-mail-is-confirmed').length > 0)
    {
        $('#popup-your-mail-is-confirmed').modal({
            showClose: false,
            escapeClose: true,
            clickClose: false
        });

        $('#popup-your-mail-is-confirmed').on('click', '.popup-close', function () {
            changeUrl();
        });

        $(document).keyup(function(e) {
            if (e.key === "Escape") {
                changeUrl();
            }
        });
    }
});

function changeUrl() {
    history.pushState({}, '', window.location.origin);
}