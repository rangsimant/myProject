var button;
var user_id;
var note_id;
var author_id;
var profilename;
var username;
var first_name;
var last_name;
var address;
var email;
var tel;
var note;


function showDataOnModal () 
{
	$('#patient-modal').on('show.bs.modal', function (event) {
		$('#note').val('');
	  	button = $(event.relatedTarget) // Button that triggered the modal
		user_id = button.data('userid');
		author_id = button.data('authorid');
	  	getPatientAndNote();
	});
}

function showConfirm() 
{
	$('#confirm-modal').on('show.bs.modal', function (event) {
		$('#note').val('');
	  	button = $(event.relatedTarget) // Button that triggered the modal
		note_id = button.data('noteid');
	});
}

function deleteNote()
{
	$( '#form-delete-note' ).on( 'submit', function() {
 
        //.....
        //show some spinner etc to indicate operation in progress
        //.....
        $.post(
            $( this ).prop( 'action' ),
            {
                "_token": $( this ).find( 'input[name=_token]' ).val(),
                "note_id":note_id
            },
            function( ) {
            	
            },
            'json'
        );
 		$('#confirm-modal').modal('hide');
    	getPatientAndNote();
        //.....
        //do anything else you might want to do
        //.....
 
        //prevent the form from actually submitting in browser
        return false;
    } );
}

function saveNote()
{
$( '#form-note' ).on( 'submit', function() {
 
        //.....
        //show some spinner etc to indicate operation in progress
        //.....
        $.post(
            $( this ).prop( 'action' ),
            {
                "_token": $( this ).find( 'input[name=_token]' ).val(),
                "note": $( '#note' ).val(),
                "user_id":user_id,
                "author_id":author_id
            },
            function( data ) {
            	getPatientAndNote();
            },
            'json'
        );
 
        //.....
        //do anything else you might want to do
        //.....
 
        //prevent the form from actually submitting in browser
        return false;
    } );
}

function getPatientAndNote()
{
  	
  	var modal = $('#patient-modal');

    $.ajax(
 	{
 		url:'patient/profile',
 		type:'get',
 		data:{user_id:user_id,author_id:author_id},
 		dataType:'json',
 		success:function(data)
 		{	
 			if (data['profile'].length > 0) 
 			{
 				var name = data['profile'][0].first_name+" "+data['profile'][0].last_name;
 				modal.find('.modal-title').text('Profile (' + name+ ') ID : '+user_id)
			  	modal.find('.modal-body input').val(data['profile'][0].username)
			  	modal.find('#patient-firstname').val(data['profile'][0].first_name);
			  	modal.find('#patient-lastname').val(data['profile'][0].last_name);
			  	modal.find('#address').val(data['profile'][0].address);
			  	modal.find('#email').val(data['profile'][0].email);
			 	modal.find('#tel').val(data['profile'][0].tel);
 			}
 			else
 			{
 				console.log('This User not found profile');
 			}

			modal.find('.panel-group').html(""); // clear list notes

 			if (data['note'].length > 0) 
			{
				$.each(data['note'],function(index,value)
				{
					var updated_at = moment(value.updated_at, 'YYYY/MM/DD HH:mm:ss').fromNow();
					var created = moment(value.created_at).format('DD MMM YY HH:mm:ss');
					var updated = moment(value.updated_at).format('DD MMM YY HH:mm:ss');
					var author_name = value.author_first_name+" "+value.author_last_name;
					var maxLength = 50;
					if (value.notes.length > maxLength) 
					{
						var title = value.notes.substring(0, maxLength)+"...";
					}else
					{
						var title = value.notes;
					}
					var collapse = "<div class='panel panel-default'> <a data-toggle='collapse' data-parent='#accordion' href='#"+value.id+"' aria-expanded='true' aria-controls='collapseOne'> <div class='panel-heading' role='tab' id='headingOne'> <h4 class='panel-title'>"+title+"<span class='pull-right'>"+updated_at+"</span> </h4> </div> </a> <div id='"+value.id+"' class='panel-collapse collapse' role='tabpanel' aria-labelledby='headingOne'> <div class='panel-body'> "+value.notes+"</div> <div class='panel-footer text-right'><a class='btn btn-warning btn-xs' href='#'>edit</a><a class='btn btn-danger btn-xs' href='#' data-toggle='modal' data-target='#confirm-modal' data-noteid="+value.id+" >delete</a> <p>Created : "+created+" by : "+author_name+"</div> </div> </div>";
					modal.find('.panel-group').append(collapse);
					console.log('Have '+data['note'].length+' notes.');
				});
			}
			else
			{
				console.log('This user no notes.');
			}
 		}

 	});
}