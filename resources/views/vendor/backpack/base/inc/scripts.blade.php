<!-- jQuery 3.3.1 -->
<script src="{{ asset('vendor/adminlte') }}/bower_components/jquery/dist/jquery.min.js"></script>
{{-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>window.jQuery || document.write('<script src="{{ asset('vendor/adminlte') }}/bower_components/jquery/dist/jquery.min.js"><\/script>')</script> --}}

<!-- Bootstrap 3.4.1 -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
<script src="{{ asset('vendor/adminlte') }}/plugins/pace/pace.min.js"></script>
<script src="{{ asset('vendor/adminlte') }}/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
{{-- <script src="{{ asset('vendor/adminlte') }}/bower_components/fastclick/lib/fastclick.js"></script> --}}
<script src="{{ asset('vendor/adminlte') }}/dist/js/adminlte.js"></script>

<!-- page script -->
<script type="text/javascript">
    // To make Pace works on Ajax calls
    $(document).ajaxStart(function() { Pace.restart(); });

    // Ajax calls should always have the CSRF token attached to them, otherwise they won't work
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    {{-- Enable deep link to tab --}}
    var activeTab = $('[href="' + location.hash.replace("#", "#tab_") + '"]');
    location.hash && activeTab && activeTab.tab('show');
    $('.nav-tabs a').on('shown.bs.tab', function (e) {
        location.hash = e.target.hash.replace("#tab_", "#");
    });
</script>


<script type="text/javascript">
    $(document).ready(function () {
        $('#viewUser').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var name = button.data('name');
            var modal = $(this);
            var personTab = $('#personTab');
            var upcomingTab = $('#upcomingTab');
            var pastTab = $('#pastTab');

            $.each([
                personTab,
                upcomingTab,
                pastTab
            ], function (index, tab) {
                tab.removeClass('active');
            });

            $('#viewUser .nav-tabs li').each(function (index, value) {
                $(value).removeClass('active');
            })

            personTab.addClass('active');
            $('#viewUser .nav-tabs li:first').addClass('active');

            modal.find('.modal-title .modal-title__id').text(id);
            modal.find('.modal-title .modal-title__name').text(name);

            const URL_UPCOMING_EVENT = '/admin/upcoming-events/';
            const URL_PAST_EVENT = '/admin/past-events/';


            $.get( "/admin/user/" + id + "/show", function( response ) {
                var data = JSON.parse(response);

                /** PERSONAL INFO */
                if (data.personal_info) {
                    var table = $('#viewUserTable');
                    $.each(data.personal_info, function( key, value ) {
                        var td = table.find('td[data-key="' + key + '"]');

                        if (td.length > 0) {
                            td.text(value);
                        }
                    });
                }

                /** UPCOMING EVENT */
                if (data.upcoming_events) {
                    links = '<ul>';
                    $.each(data.upcoming_events, function( index, event ) {
                        links += '<li><a href="' + URL_UPCOMING_EVENT + event.id + '/edit" target="_blank">' + event.title + '</a></li>';
                    });
                    links += '</ul>';

                    upcomingTab.html( links );
                }

                /** PAST EVENT */
                if (data.past_events) {
                    links = '<ul>';
                    $.each(data.past_events, function( index, event ) {
                        links += '<li><a href="' + URL_PAST_EVENT + event.id + '/edit" target="_blank">' + event.title + '</a></li>';
                    });
                    links += '</ul>';

                    pastTab.html( links );
                }
            });
        });
    })
</script>
























