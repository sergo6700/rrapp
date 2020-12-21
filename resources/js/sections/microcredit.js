$('#microcredit-step-1').on('submit', function(event) {
    event.preventDefault()
    var form = event.currentTarget;
    var data = {
        'sex':3,
        'birth-date': '2018-07-22',
        'monogorod': 0,
        'reg-date':2
    }
    console.log($(form).attr('action'));
    console.log(data);

    $.ajax({
        method: "GET",
        data: data,
        cache: false,
        url: $(form).attr('action'),
        success: function success(respons) {
            console.log(respons.data);
            window.location.hash = '#step2'
            //toggleStep()
        },
        error: function error(_error) {
          console.log(_error);
        }
      });
})
function toggleStep() {
    var step1 = $('#content-step1')
    var step2 = $('#content-step2')
    step1.toggleClass('step-microcredit--show')
    step2.toggleClass('step-microcredit--show')
}

$('.back-step').click(function() {
    window.location.hash = '#step1'
    //toggleStep()
});



$(window).on('hashchange', function() {
    var exist = ['step1', 'step2', 'step3']
    if (!exist.includes(window.location.hash.slice(1))) {
        window.location.hash = '#step1'
    }
    var step = window.location.hash  ? $('#content-' + window.location.hash.slice(1)) : $('#content-step1')
    $('.step-microcredit').not(step).removeClass('step-microcredit--show')
    step.addClass('step-microcredit--show')
});

$(document).ready(function() {
    var test = false
    var exist = ['step1', 'step2', 'step3']
    if (!exist.includes(window.location.hash.slice(1)) && test) {
        window.location.hash = '#step1'
    }
    var step = window.location.hash ? $('#content-' + window.location.hash.slice(1)) : $('#content-step1')
    $('.step-microcredit').not(step).removeClass('step-microcredit--show')
    step.addClass('step-microcredit--show')
});

