$(document).ready(function() {
    
    $('i').hover(function(){
		$(this).tooltip('show')
	});
	
	$('.group-checkable, .styled').uniform();

    $.fn.charCounter = function (max, settings) {
        max = max || 100;
        settings = $.extend({
            container: '<span></span>',
            classname: 'charcounter',
            format: '(Còn lại %1 kí tự)',
            pulse: true,
            delay: 0
        }, settings);
        var p, timeout;

        function count(el, container) {
            el = $(el);
            if (el.val().length > max) {
                el.val(el.val().substring(0, max));
                if (settings.pulse && !p) {
                    pulse(container, true);
                };
            };
            if (settings.delay > 0) {
                if (timeout) {
                    window.clearTimeout(timeout);
                }
                timeout = window.setTimeout(function () {
                    container.html(settings.format.replace(/%1/, (max - el.val().length)));
                }, settings.delay);
            } else {
                container.html(settings.format.replace(/%1/, (max - el.val().length)));
            }
        };

        function pulse(el, again) {
            if (p) {
                window.clearTimeout(p);
                p = null;
            };
            el.animate({ opacity: 0.1 }, 100, function () {
                $(this).animate({ opacity: 1.0 }, 100);
            });
            if (again) {
                p = window.setTimeout(function () { pulse(el) }, 200);
            };
        };

        return this.each(function () {
            var container;
            if (!settings.container.match(/^<.+>$/)) {
                // use existing element to hold counter message
                container = $(settings.container);
            } else {
                // append element to hold counter message (clean up old element first)
                $(this).next("." + settings.classname).remove();
                container = $(settings.container)
                                .insertAfter(this)
                                .addClass(settings.classname);
            }
            $(this)
                .unbind('.charCounter')
                .bind('keydown.charCounter', function () { count(this, container); })
                .bind('keypress.charCounter', function () { count(this, container); })
                .bind('keyup.charCounter', function () { count(this, container); })
                .bind('focus.charCounter', function () { count(this, container); })
                .bind('mouseover.charCounter', function () { count(this, container); })
                .bind('mouseout.charCounter', function () { count(this, container); })
                .bind('paste.charCounter', function () {
                    var me = this;
                    setTimeout(function () { count(me, container); }, 10);
                });
            if (this.addEventListener) {
                this.addEventListener('input', function () { count(this, container); }, false);
            };
            count(this, container);
        });
    };

    $('input[data-counter], textarea[data-counter]').click(function(event) {
        $(this).charCounter($(this).data('counter'), {
          container: '<small></small>'
        });
    });

    if (jQuery().select2) {
        $('.select-multiple').select2({
            width: '100%',
            allowClear: true,
            placeholder: 'Select...'
        });
        $('.select-search-full').select2({
            width: '100%'
        });
        $('.select-full').select2({
            width: '100%',
            minimumResultsForSearch: -1
        });
    }

    if (jQuery().datetimepicker) {
        $('.datetimepicker').datetimepicker({
            format: 'DD/MM/YYYY'
        });
    }

});

function showNotice(messageType, message, messageHeader) {
    toastr.options = {
        closeButton: true,
        positionClass: 'toast-bottom-right',
        onclick: null,
        showDuration: 1000,
        hideDuration: 1000,
        timeOut: 10000,
        extendedTimeOut: 1000,
        showEasing: 'swing',
        hideEasing: 'linear',
        showMethod: 'fadeIn',
        hideMethod: 'fadeOut'

    };
    var $toast = toastr[messageType](message, messageHeader);
}
