$(function () {

    //login
    $(".cc-loginFormUser").submit(function(e){
        e.preventDefault();
        var formData = $(this).serialize();
        var loginForm = $(this);
        $.ajax({
            url:'login',
            type:'post',
            data:formData,
            beforeSend: function(){
                loginForm.find("button[type=submit] i").removeClass('hidden');
                loginForm.find(".msg-login").html('');
            },
            success: function(data) {
                loginForm.find("button[type=submit] i").addClass('hidden');
                console.log(data);
                if(!data.error){
                    $(location).attr('href', data.redirect)
                }else{
                    loginForm.find(".msg-login").html('<div class="err">Your email or password does not match!</div>');
                }
            }
        });
    });

    $("#cc-request-acount").click(function(e){
        e.preventDefault();
        $('#cc-modal-request-account').modal()
    })

    function loadDayOfWeek(){
            var today = new Date();
            var mondayOfWeek = new Date(today.getFullYear(), today.getMonth(), today.getDate() - today.getDay()+1);
            var tuesdayOfWeek = new Date(today.getFullYear(), today.getMonth(), today.getDate() - today.getDay()+2);
            var wednesdayOfWeek = new Date(today.getFullYear(), today.getMonth(), today.getDate() - today.getDay()+3);
            var thursdayOfWeek = new Date(today.getFullYear(), today.getMonth(), today.getDate() - today.getDay()+4);
            var fridayOfWeek = new Date(today.getFullYear(), today.getMonth(), today.getDate() - today.getDay()+5);
            var saturdayOfWeek = new Date(today.getFullYear(), today.getMonth(), today.getDate() - today.getDay()+6);
            var sundayOfWeek = new Date(today.getFullYear(), today.getMonth(), today.getDate() - today.getDay()+7);

            $("#mondays").val($.datepicker.formatDate('mm/dd/yy', new Date(mondayOfWeek)));
            $("#tuesdays").val($.datepicker.formatDate('mm/dd/yy', new Date(tuesdayOfWeek)));
            $("#wednesdays").val($.datepicker.formatDate('mm/dd/yy', new Date(wednesdayOfWeek)));
            $("#thursdays").val($.datepicker.formatDate('mm/dd/yy', new Date(thursdayOfWeek)));
            $("#fridays").val($.datepicker.formatDate('mm/dd/yy', new Date(fridayOfWeek)));
            $("#saturdays").val($.datepicker.formatDate('mm/dd/yy', new Date(saturdayOfWeek)));
            $("#sundays").val($.datepicker.formatDate('mm/dd/yy', new Date(sundayOfWeek)));
        }
        loadDayOfWeek();


        $('#datepicker').datetimepicker({
            showTimepicker: false,
            showButtonPanel: true,
            beforeShow: function (input) {
                setTimeout(function () {
                    var buttonPane = $(input)
                            .datepicker("widget")
                            .find(".ui-datepicker-buttonpane");

                    var btn = $('<div style="padding: 0 15px 10px 15px"><button class="btn btn-search" style="width:100%; font-size:12px;padding:0;" type="button">Switch To Contract Time Bookings</button></div>');
                    btn.unbind("click")
                            .bind("click", function (e) {
                            $("#datepicker").datepicker( "hide" );
                            $("#calendar-switch").css({
                                top: $("#ui-datepicker-div").offset().top,
                                left: $("#ui-datepicker-div").offset().left
                            })
                            $("#calendar-switch").show();
                            e.stopPropagation();
                            });

                    buttonPane.replaceWith(btn);

                }, 1);
            },
            onSelect: function (dateText, inst) {
                $("#calendar-switch").hide();
            }
        });
        $('html').click(function() {
            $("#calendar-switch").hide();
        });
        $("#calendar-switch").click(function(e){
            e.stopPropagation();
        });
        $('#calendar-switch input[type="checkbox"]').click(function(e){
            $('#calendar-switch input[type="checkbox"]').not(this).prop( "checked", false ).parent().css("color", "#999999");

            if($(this).is(':checked')){
                $(this).parent().css("color", "#63ac1e");
                $('#datepicker').datepicker("setDate", new Date($(this).val()));
                $("#calendar-switch").hide();
            }else{
                $(this).parent().css("color", "#999999");
            }
        });
        $("#calendar-switch-button").click(function(e){
            $("#calendar-switch").fadeOut("slow");
            $("#datepicker").datepicker( "show" );
        });
        $('#timepicker').timepicker({
            timeOnlyTitle: 'Start Time',
            showButtonPanel: false,
            showHour: false,
            showMinute: false,
            hour: 9,
            timeFormat: 'hh:mm TT',
            timeText: '',
            timeInput: true
        });
    });