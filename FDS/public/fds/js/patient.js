var button;
var user_id;
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
	  	getPatientandNote();
	});
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
            	getPatientandNote();
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

function getPatientandNote()
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
					var updated_at = moment(value.updated_at, "YYYY/MM/DD h:mm:ss a").fromNow();
					var created = moment(value.created_at).format('DD MMM YY h:mm:ss a');
					var updated = moment(value.updated_at).format('DD MMM YY h:mm:ss a');
					var collapse = "<div class='panel panel-default'> <a data-toggle='collapse' data-parent='#accordion' href='#"+value.id+"' aria-expanded='true' aria-controls='collapseOne'> <div class='panel-heading' role='tab' id='headingOne'> <h4 class='panel-title'>"+value.notes+"<span class='pull-right'>"+updated_at+"</span> </h4> </div> </a> <div id='"+value.id+"' class='panel-collapse collapse' role='tabpanel' aria-labelledby='headingOne'> <div class='panel-body'> "+value.notes+"</div> <div class='panel-footer text-right'> <p>by : "+value.author_first_name+" "+value.author_last_name+"</div> </div> </div>";
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