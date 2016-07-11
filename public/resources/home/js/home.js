$(function () {
    var key_googleapi = "AIzaSyC4Bb68mvFmien-T9YQXJfuNpCLFJw4bic";
    if($('#q').length)
        $('#q').cityAutocomplete();

    $('#card-expiry1').datetimepicker({
        showTimepicker: false,
        showButtonPanel: false,
        changeMonth: true,
        changeYear: true,
        dateFormat: 'mm/yy',
        onClose: function(dateText, inst) {
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).val($.datepicker.formatDate('mm/yy', new Date(year, month, 1)));
        }
    });
    $("#card-expiry1").focus(function () {
        $(".ui-datepicker-calendar").hide();
        $("#ui-datepicker-div").position({
            my: "center top",
            at: "center bottom",
            of: $(this)
        });
    });
    $('#card-expiry').datetimepicker({
        format: 'MM/YY',
    })
    if (jQuery().select2) {
        $('.select2').select2({
            width: '100%',
            minimumResultsForSearch: -1
        });
    }

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
    //loadDayOfWeek();

    var dateNow = new Date();

    $('#datepicker').datetimepicker({
        minDate: 0,
        //maxDate: "+1M +10D",
        showTimepicker: false,
        showButtonPanel: true,
        format: 'mm/dd/yy',
        nextText: "abc",
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
                            top: 38,
                            left: 15
                        })
                        $("#calendar-switch").show();
                        e.stopPropagation();
                    });

                buttonPane.replaceWith(btn);

            }, 1);
        },
        onChangeMonthYear: function(input) {
            setTimeout(function () {
                var buttonPane = $(input)
                    .datepicker("widget")
                    .find(".ui-datepicker-buttonpane");

                var btn = $('<div style="padding: 0 15px 10px 15px"><button class="btn btn-search" style="width:100%; font-size:12px;padding:0;" type="button">Switch To Contract Time Bookings</button></div>');
                btn.unbind("click")
                    .bind("click", function (e) {
                        $("#datepicker").datepicker( "hide" );
                        $("#calendar-switch").css({
                            top: 38,
                            left: 15
                        })
                        $("#calendar-switch").show();
                        e.stopPropagation();
                    });

                buttonPane.replaceWith(btn);

            }, 1);
        },
        onSelect: function (dateText, inst) {
            //$("#calendar-switch").hide();
        }
    });//.datepicker('setDate', dateNow);

    $("#calendar-switch").click(function(e){
        e.stopPropagation();
    });
    $("html").click(function(){
        $("#calendar-switch").hide();
    })
    $('#calendar-switch input[type="checkbox"]').click(function(e){
        ////$('#calendar-switch input[type="checkbox"]').not(this).prop( "checked", false ).parent().css("color", "#999999");
        //
        //if($(this).is(':checked')){
        //    $(this).parent().css("color", "#63ac1e");
        //    $('#datepicker').datepicker("setDate", new Date($(this).val()));
        //    //$("#calendar-switch").hide();
        //}else{
        //    $(this).parent().css("color", "#999999");
        //}
    });
    $("#calendar-switch-button").click(function(e){
        $("#calendar-switch").fadeOut("slow");
        $("#datepicker").datepicker( "show" );
    });

    $("#search-timepicker").click(function(){
        $(".search-tooltip").toggleClass('hidden');
        if(!$(".search-tooltip").hasClass('hidden')){
            $("#cc-input-search-time").focus();
        }
    });

    $(".group-search-home-timepicker").mouseleave(function() {
        $(".search-tooltip").addClass('hidden');
    });

    $(".placeholder-single").select2({
        placeholder: "# Courts",
        allowClear: true,
        containerCss: 'wrap',
        templateResult: function(result){
            $(".select2-search__field").remove();
            var el = $('<span>');
            el.text( result.text );
            el.addClass('select-court');
            return el;
        }
    });

    $("#mb-book-in-hour").ionRangeSlider({
        min: 1,
        max: 3.5,
        type: 'single',
        step: 0.5,
        grid: false,
        postfix: " Hour",
        prettify: false,
        hasGrid: true,
        hideMinMax: true,
        hide_min_max: true
    });

    $("#mb-book-distance").ionRangeSlider({
        min: 1,
        max: 20,
        type: 'single',
        step: 1,
        grid: false,
        postfix: " miles",
        prettify: false,
        hasGrid: false,
        hideMinMax: false,
    });

    var currentRequest = null;
    $( "#q1" ).autocomplete({
        source: function( request, response ) {
            currentRequest = $.ajax({
                url: "search/autocomplete?term=" + request.term,
                beforeSend: function(){
                    console.log(currentRequest);
                    if(currentRequest != null) {
                        currentRequest.abort();
                    }
                },
                success: function( data ) {
                    response( $.map( data, function( item ) {
                        return {
                            label: item.value,
                            value: item.type + "|" + item.value,
                        }
                    }));
                }
            });
        },
        minLength: 3,
        select: function(event, ui) {
            $('#q').val(ui.item.value);
        }
    });

    $('.city-autocomplete, .content-view-more-court').mCustomScrollbar({
        axis: "y",
        theme: "dark"
    });


    function setTimeSearch() {
        // set time current
        var timeNow = new Date();
        var hours   = timeNow.getHours();
        var minutes = timeNow.getMinutes();
        if(minutes <= 30) minutes = 30;
        else{
            hours +=1;
            minutes = "00";
        }
        $("#cc-input-search-time").val((hours < 10 ? "0" + hours : hours) + ":" + minutes);
    }
    $("#search-timepicker").val($("#cc-input-search-time").val());
    $("#cc-input-search-time").change(function(){
        $("#search-timepicker").val($(this).val());
    })

    //validate time search
    $("#cc-search-form").on('submit',function(e){

        var tmp_day_of_w = $("input[name='dayOfWeek[]']:checked").map(function() {
            return this.value;
        }).get();
        if(tmp_day_of_w.length <= 0) {
            if($("#datepicker").val() == null || $("#datepicker").val() == ''){
                alert("Date is required!");
                e.preventDefault();
                return false;
            }
        }

        //for safari
        var ref = $(this).find("[required]");
        var error_safari = false;
        $(ref).each(function(){
            if ( $(this).val() == '' )
            {
                alert("Required field should not be blank.");
                $(this).focus();
                e.preventDefault();
                error_safari = true;
                return false;
            }
        });
        if(!error_safari) {
            timeNow = new Date();
            var dateInput = $("input[name=date]").val().split("/");
            var timeInput = $("input[name=s_time]").val().split(":");
            var tmp_date = new Date(dateInput[2], dateInput[0] - 1, dateInput[1], timeInput[0], timeInput[1]);
            if (tmp_date.getTime() < timeNow.getTime()) {
                alert("Date or time can't less than current time!");
                e.preventDefault();
            }
            else $(".loader").toggleClass('hidden');
        }
    });


    //lookup address
    $("body").on('click','.btn-get-address-lookup',function(){
        var zipcode;
        if($("#input-zip_code").length)
            zipcode = $("#input-zip_code").val();
        else zipcode = $("input[name=zipcode]").val();
        $.ajax({
            url : "http://maps.googleapis.com/maps/api/geocode/json?components=postal_code:"+zipcode,
            method: "post",
            success:function(data){
                $("#input-address1").val('');
                $("#input-address2").val('');
                $.each(data.results[0].address_components, function(index, val) {
                    if (typeof val.types[0] != "undefined" ) {
                        if(val.types[0] == 'administrative_area_level_1'){
                            $("input[name=state], #input-state").val(val.long_name);
                        }
                        if(val.types[0] == "locality"){
                            $("input[name=city], #input-city").val(val.long_name);
                        }
                    }
                });
            }
        });
    });

    $("#input-address1").geocomplete()
        .bind("geocode:result", function(event, result){
            $.each(result.address_components, function(index, val) {
                if (typeof val.types[0] != "undefined" ) {
                    if(val.types[0] == "locality"){
                        $("#input-city").val(val.long_name);
                    }
                    if(val.types[0] == 'administrative_area_level_1'){
                        $("#input-state").val(val.long_name);
                    }
                    if(val.types[0] == "postal_code"){
                        $("#input-zip_code").val(val.long_name);
                    }
                    if(val.types[0] == "country"){
                        $("#input-country").val(val.short_name);
                    }
                }
            });
        });

    //
    $("body").on('click','.btn-booking-tennis.disabled',function(e){
        e.preventDefault();
    })

});