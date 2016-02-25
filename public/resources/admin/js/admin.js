$(document).ready(function() {
    $('#task').change(function(){
        var check = true;
        if ($(this).val()=="trash") {

        }
        if (check) {
            $('#admin_form').submit();
        } else {
            $('#task option:first-child').prop('selected', true);
        }
    });
    
    $('i').hover(function(){
			$(this).tooltip('show')
	});
	
	if ($.iCheck) {
		$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
			checkboxClass: 'icheckbox_minimal-blue',
			radioClass: 'iradio_minimal-blue'
		});
		$('#check_all').on('ifClicked', function(event){
			$('input[type="checkbox"].minimal').iCheck('toggle');
		});
	}

    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });

});

