$(document).ready(function () {
    if ($('#data-masck').length > 0) {
        $('#data-masck').mask("99.99.9999", {placeholder: "дд.мм.гггг" });
    }
    $(function () {
        if ($('.calendar-collapse').length > 0) {
            $('.calendar-collapse').accordion({
                collapsible: true,
                active: 1,
                beforeActivate: function (event, ui) {
                    handlerEventAccordion(this, event);
                },
            });
        }
    });

    $(function () {
        if ($('.news-collapse').length > 0) {
            $('.news-collapse').accordion({
                collapsible: true,
                active: 1,
                beforeActivate: function (event, ui) {
                    handlerEventAccordion(this, event);
                },
            });
        }
    });

    $(function () {
        if ($('.services-collapse').length > 0) {
            $('.services-collapse').accordion({
                collapsible: true,
                active: 1,
                beforeActivate: function (event, ui) {
                    handlerEventAccordion(this, event);
                },
            });
        }
    });

    if ($('.template-text-container ol li span').length > 0) {
        // находим элементы списка, содержащие тег <span>, установленный в редакторе CKEDITOR
        var elements_list = $('.template-text-container ol li:has(span)');

        // применяем стили к каждому отфильтрованному элементу списка
        var cssRules = null;
        elements_list.each(function () {
            cssRules = $(this)
                .find('span')
                .attr('style');
            $(this).attr('style', cssRules);
        });
    }

    // добавить подчёркивание для ссылок в блоке "collapse"
    $('.template-collapse-wrapper').each(function () {
        $(this).find('.template-collapse__text').each(function (index) {
            if (index !== 0) {
                $(this).addClass('template-collapse__text_middl');
            }
        });
    });
});

function handlerEventAccordion($this, event) {
    var isActive = $($this).ac;

    let target = event.originalEvent.target,
        classList = $(target).attr('class'),
        classListParent = $(target.parentElement).attr('class');

    if (
        typeof classList != 'undefined' &&
        classList.includes('template-collapse__icon')
    ) {
        return false;
    } else if (
        typeof classListParent != 'undefined' &&
        classListParent.includes('template-collapse__icon')
    ) {
        return false;
    }

    if (!isActive && target.hasAttribute('href')) {
        location.href = target.getAttribute('href');
    }

    event.preventDefault();
}
