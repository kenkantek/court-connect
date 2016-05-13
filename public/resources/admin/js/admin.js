
function partPrint(element) {
    var printContents = $("#InfoOrderComplete").html();
    $("body *").addClass('notprint');
    $("body").append("<div id='printable'>"+printContents+"</div>");
    window.print();
    $("#printable").remove();
    $("body *").removeClass('notprint');
}
$(document).ready(function () {
    $('body').on('click','.editable',function (e) {
        e.stopPropagation();
        var value = $(this).html();
        updateVal(this, value);
    });

    function updateVal(currentEle, value) {
        $(currentEle).html('<input class="thVal" maxlength="4" type="text" width="2" value="' + value + '" />');
        $(".thVal", currentEle).focus().keyup(function (event) {
            if (event.keyCode == 13) {
                $(currentEle).html($(".thVal").val().trim());
            }
        }).click(function(e) {
            e.stopPropagation();
        });

        $(document).click(function() {
            $(".thVal").replaceWith(function() {
                return this.value;
            });
        });
    }
    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
    });
});
function showNotice(t,e,n){toastr.options={closeButton:!0,positionClass:"toast-bottom-right",onclick:null,showDuration:1e3,hideDuration:1e3,timeOut:1e4,extendedTimeOut:1e3,showEasing:"swing",hideEasing:"linear",showMethod:"fadeIn",hideMethod:"fadeOut"};toastr[t](e,n)}$(document).ready(function(){$("i").hover(function(){$(this).tooltip("show")}),$(".group-checkable, .styled").uniform(),$.fn.charCounter=function(t,e){function n(n,c){n=$(n),n.val().length>t&&(n.val(n.val().substring(0,t)),e.pulse&&!o&&i(c,!0)),e.delay>0?(a&&window.clearTimeout(a),a=window.setTimeout(function(){c.html(e.format.replace(/%1/,t-n.val().length))},e.delay)):c.html(e.format.replace(/%1/,t-n.val().length))}function i(t,e){o&&(window.clearTimeout(o),o=null),t.animate({opacity:.1},100,function(){$(this).animate({opacity:1},100)}),e&&(o=window.setTimeout(function(){i(t)},200))}t=t||100,e=$.extend({container:"<span></span>",classname:"charcounter",format:"(Còn lại %1 kí tự)",pulse:!0,delay:0},e);var o,a;return this.each(function(){var t;e.container.match(/^<.+>$/)?($(this).next("."+e.classname).remove(),t=$(e.container).insertAfter(this).addClass(e.classname)):t=$(e.container),$(this).unbind(".charCounter").bind("keydown.charCounter",function(){n(this,t)}).bind("keypress.charCounter",function(){n(this,t)}).bind("keyup.charCounter",function(){n(this,t)}).bind("focus.charCounter",function(){n(this,t)}).bind("mouseover.charCounter",function(){n(this,t)}).bind("mouseout.charCounter",function(){n(this,t)}).bind("paste.charCounter",function(){var e=this;setTimeout(function(){n(e,t)},10)}),this.addEventListener&&this.addEventListener("input",function(){n(this,t)},!1),n(this,t)})},$("input[data-counter], textarea[data-counter]").click(function(t){$(this).charCounter($(this).data("counter"),{container:"<small></small>"})}),jQuery().select2&&($(".select-multiple").select2({width:"100%",allowClear:!0,placeholder:"Select..."}),$(".select-search-full").select2({width:"100%"}),$(".select-full").select2({width:"100%",minimumResultsForSearch:-1})),jQuery().datetimepicker&&$(".datetimepicker").datetimepicker({format:"DD/MM/YYYY"})});