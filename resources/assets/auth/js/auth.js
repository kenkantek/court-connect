$(document).ready(function() {
	
	$('.styled').uniform();

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