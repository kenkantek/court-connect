jQuery(document).ready(function($) {    
  $('div.dataTables_filter').append('<a id="btnAddUser" class="btn btn-flat btn-primary pull-right"> New User</a>');
	$('#btnAddUser').click(function(event) {
		$('#box-form-create').removeClass('hidden');
		$('#box-form-edit').addClass('hidden');
		return false;
	});
	$('#btnUserSubmit').click(function(event) {
		var user = {};
		user.fullname = $('#fullname').val();
		user.email = $('#email').val();
		user.password = $('#password').val();
		user.is_admin = $('#is_admin:checked').val();
		$.ajax({
            url: laroute.route('users.create.post'),
            type: 'POST',
            data: user,
            success: function(data, textStatus) {
            		if (data.error) {
                    showNotice('error', data.message, 'Error!');
                } else {                   
                     window.oTable.draw( false );
                    showNotice('success', data.message, 'Success!');
                    $('.form-group').removeClass('has-error');

                    $("#form-user").get(0).reset();
                    $.uniform.update($('#is_admin'));
                }

            },
            error: function(error) {
               $.each(error.responseJSON, function(index, message) {
               		$('#'+index).closest('.form-group').addClass('has-error');
            			 showNotice('error', message, 'Error!');
            		});
            }
        });
		return false;
	});
	$('#btnUserEdit').click(function(event) {
		var user = {};
		user.fullname = $('#fullname-edit').val();
		user.email = $('#email-edit').val();
		user.password = $('#password-edit').val();
		user.is_admin = $('#is_admin-edit:checked').val();
		user.id = $('#user_id').val();
		$.ajax({
            url: laroute.route('users.edit.post'),
            type: 'POST',
            data: user,
            success: function(data, textStatus) {
            		if (data.error) {
                    showNotice('error', data.message, 'Error!');
                } else {                   
                     window.oTable.draw( false );
                    showNotice('success', data.message, 'Success!');
                    $('.form-group').removeClass('has-error');

                    $("#form-user").get(0).reset();
                    $.uniform.update($('#is_admin'));
                }

            },
            error: function(error) {
               $.each(error.responseJSON, function(index, message) {
               		$('#'+index+'-edit').closest('.form-group').addClass('has-error');
            			 showNotice('error', message, 'Error!');
            		});
            }
        });
		return false;
	});
$('#datatables').on( 'click', 'tr', function () {
			$('#box-form-edit').removeClass('hidden');
			$('#box-form-create').addClass('hidden');
      $(this).find('tr.selected').removeClass('selected');
      $(this).addClass('selected');
      $(this).find('.td:nth-child(1)').val();
      var fullname = $(this).find('td:nth-child(1)').text();
      var email = $(this).find('td:nth-child(2)').text();
      var user_id = $(this).find('td:nth-child(2) span').data('id');
      var is_admin = $(this).find('td:nth-child(3)').text(); 
      $('#fullname-edit').val(fullname);
		  $('#email-edit').val(email);
		  $('#user_id').val(user_id);
		  if (is_admin == 'Yes') {
		  	$('#is_admin-edit').prop('checked', true)
		  	$.uniform.update($('#is_admin-edit'));
		  }else{
		  	$('#is_admin-edit').prop('checked', false)
		  	$.uniform.update($('#is_admin-edit'));
		  }      
    } );
 $(document).on('click', '#btnUserDelete', function (event) {
        event.preventDefault();
        $('#delete-crud-entry').data('id', $('#user_id').val());
        $('#delete-crud-modal').modal('show');
    });

    $('#delete-crud-entry').on('click', function (event) {
        event.preventDefault();
        $('#delete-crud-modal').modal('hide');
        var id = $(this).data('id');
        $.ajax({
            url: laroute.route('users.delete')+'/'+id ,
            type: 'GET',
            success: function(data, textStatus) {
                if (data.error) {
                    showNotice('error', data.message, 'Error!');
                } else {    
                		window.oTable.draw( false ); 
                    showNotice('success', data.message, 'Success!');
                }
            },
            error: function(data) {
               showNotice('error', data.responseJSON.message, 'Error!');
            }
        });
    });

});