var button; // Button that triggered the modal
var user_id;
var profilename;
var username; // Extract info from data-* attributes
var first_name;
var last_name;
var address;
var email;
var tel;
var note;


function showDataOnModal () 
{
	$('#patient-modal').on('show.bs.modal', function (event) {
	  	button = $(event.relatedTarget) // Button that triggered the modal
		user_id = button.data('userid');
	  	profilename = button.data('profilename');
	  	username = button.data('username') // Extract info from data-* attributes
	  	first_name = button.data('firstname');
	  	last_name = button.data('lastname');
	  	address = button.data('address');
	  	email = button.data('email');
	  	tel = button.data('tel');
	  	note = button.data('note');
	  	// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	  	// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	  	var modal = $(this)
	  	modal.find('.modal-title').text('Profile (' + profilename +') ID : '+user_id)
	  	modal.find('.modal-body input').val(username)
	  	modal.find('#patient-firstname').val(first_name);
	  	modal.find('#patient-lastname').val(last_name);
	  	modal.find('#address').val(address);
	  	modal.find('#email').val(email);
	 	modal.find('#tel').val(tel);
	 	modal.find('#note').val(note);
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
                "user_id":user_id
            },
            function( data ) {
                //do something with data/response returned by server
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