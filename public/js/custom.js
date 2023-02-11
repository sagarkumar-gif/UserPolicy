jQuery(function($){
    var dataTable = $('#user-table').DataTable({	
        "processing": true,
        "serverSide": true,
    	"order": [0, 'ASC'],
    	"ajax": {
			type: "POST",
			url: "/users/all-users",
			dataType: 'JSON',
            error: function(error) {
                console.log(error);
            },	    		
    	},
		"columnDefs": [
			{
				"targets": [4,8],
				"orderable": false,
			},
		],
    });

	$('#add-this-user').on('click', function(e){
		e.preventDefault();
		$('#user-action-form')[0].reset();
		$('#status-message').html("");
	    $('#modal-title').text('Add New User');
	    $('#user-submit').val('Add User');
		$(document.body).append('<script>var useridEdit=null;</script>');
	});

	// Loads user data
	$('#user-table').on('click', '#edit-this-user', function(e){
		e.preventDefault();

		$('#status-message').html("");
		var fetchId = $(this).data('userid');
		$(document.body).append('<script>var useridEdit=' + fetchId + ';</script>');
	    var userId = useridEdit;

		$.ajax({
			type: 'POST',
			url: '/users/single-user',
			dataType: 'JSON',
			cache: false,
			data: {
				'userId': userId,
			},
			success: function(data){
			    $('#user-action-modal #firstname').val(data.user.firstname);
			    $('#user-action-modal #lastname').val(data.user.lastname);
			    $('#user-action-modal #policynumber').val(data.user.policynumber);
			    $('#user-action-modal #startdate').val(data.user.startdate);
			    $('#user-action-modal #enddate').val(data.user.enddate);
			    $('#user-action-modal #premium').val(data.user.premium);
			    $('#modal-title').text('Update User');
			    $('#user-submit').val('Update User');
			    console.log("Loaded");
			},
			error: function(xhr, textStatus, errorThrown) {
				if (xhr.status === 0) {
					alert('Not connect.\n Verify Network.');
				} else if (xhr.status == 404) {
					alert('Requested page not found. [404]');
	            } else if (xhr.status == 500) {
	            	alert('Server Error [500].');
	            } else if (errorThrown === 'parsererror') {
	            	alert('Requested JSON parse failed.');
	            } else if (errorThrown === 'timeout') {
	            	alert('Time out error.');
	            } else if (errorThrown === 'abort') {
	            	alert('Ajax request aborted.');
	            } else {
	            	alert('There was some error. Try again.');
	            }
			},
		});	    

	    // Opens modal
	    $('#user-action-modal').modal('show');		
	});

	// Adds and updates user
	$('#user-action-form').on('submit', function(e) {
		e.preventDefault();
		$('#status-message').html('');
		var firstname, lastname, policynumber,startdate,enddate,premium, userId;
		firstname = $('#firstname').val();
		lastname = $('#lastname').val();
		policynumber = $('#policynumber').val();
		startdate = $('#startdate').val();
		enddate = $('#enddate').val();
		premium = $('#premium').val();
		userId = useridEdit;
		$.ajax({
			type: 'POST',
			url: '/users/handle',
			dataType: 'JSON',
			cache: false,
			data: {
				'firstname': firstname, 
				'lastname': lastname, 
				'policynumber': policynumber,
				'startdate':startdate,
				'enddate': enddate,
				'premium': premium,
				'userId': userId,
			},
			success: function(data) {
				if (data.error) {
					for (i = 0; i < data.error.length; i++) {
						$('#status-message').append('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'+ data.error[i] + '</div>');
					}
				} else {
					$('#user-action-form')[0].reset();
					// Hides modal
					$('#user-action-modal').modal('hide');
					// Reloads the table
					dataTable.ajax.reload();					
				}
			},
			error: function(xhr, textStatus, errorThrown) {
				if (xhr.status === 0) {
					alert('Not connect.\n Verify Network.');
				} else if (xhr.status == 404) {
					alert('Requested page not found. [404]');
	            } else if (xhr.status == 500) {
	            	alert('Server Error [500].');
	            } else if (errorThrown === 'parsererror') {
	            	alert('Requested JSON parse failed.');
	            } else if (errorThrown === 'timeout') {
	            	alert('Time out error.');
	            } else if (errorThrown === 'abort') {
	            	alert('Ajax request aborted.');
	            } else {
	            	alert('There was some error. Try again.');
	            }
			},
		});
	});

	// Sets user id
	$('#user-delete-modal').on('show.bs.modal', function(e){
		var button = $(e.relatedTarget);
		var userId = button.data('userid');

		$(document.body).append('<script>var useridDelete=' + userId + ';</script>');
		$('#user-number-delete').text(useridDelete);
	});

	// Deletes user
	$('#delete-this-user').on('click', function(e){
		e.preventDefault();
	    var userId = useridDelete;
		$.ajax({
			type: 'POST',
			url: '/users/delete-user',
			dataType: 'JSON',
			cache: false,
			data: {
				'userId': userId,
			},
			success: function(data){
				$('#userid-edit').val("");
				// Hides modal
				$('#user-delete-modal').modal('hide');
				dataTable.ajax.reload();
			},
			error: function(xhr, textStatus, errorThrown) {
				if (xhr.status === 0) {
					alert('Not connect.\n Verify Network.');
				} else if (xhr.status == 404) {
					alert('Requested page not found. [404]');
	            } else if (xhr.status == 500) {
	            	alert('Server Error [500].');
	            } else if (errorThrown === 'parsererror') {
	            	alert('Requested JSON parse failed.');
	            } else if (errorThrown === 'timeout') {
	            	alert('Time out error.');
	            } else if (errorThrown === 'abort') {
	            	alert('Ajax request aborted.');
	            } else {
	            	alert('There was some error. Try again.');
	            }
			},
		});		
	});	
});