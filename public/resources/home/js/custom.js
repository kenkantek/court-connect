$(function () {
    $('#datepicker').datetimepicker({
        showTimepicker: false,
        showButtonPanel: true,
        beforeShow: function (input) {
            setTimeout(function () {
                var buttonPane = $(input)
                    .datepicker("widget")
                    .find(".ui-datepicker-buttonpane");

                var btn = $('<button class="btn btn-search" style="width:100%; font-size:12px;padding:0;" type="button">Switch To Contract Time Bookings</button>');
                btn.unbind("click")
                .bind("click", function () {
                    $("#datepicker").datepicker( "hide" );


                });

                buttonPane.replaceWith(btn);

            }, 1);
        }
    });
    $('#timepicker').timepicker({
        timeOnlyTitle: 'Start Time',
        showButtonPanel: false,
        showHour: false,
        showMinute: false,
        hour: 9,
        timeFormat: 'hh:mm TT',
        timeText: '',
        timeInput: true,
    });
});