@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
	{{{ $title }}} :: @parent
@stop

{{-- Content --}}
@section('content')
	<div class="page-header">
		<h3>
			{{{ $title }}}

<!-- 			<div class="pull-right">
				<a href="{{{ URL::to('admin/users/create') }}}" class="btn btn-small btn-info iframe"><span class="glyphicon glyphicon-plus-sign"></span> Create</a>
			</div> -->
		</h3>
	</div>

	<table id="patient" class="table table-striped table-hover">
		<thead>
			<tr>
				<th class="col-md-2">{{{ Lang::get('patient/patient.username') }}}</th>
				<th class="col-md-2">{{{ Lang::get('patient/patient.name') }}}</th>
				<th class="col-md-2">{{{ Lang::get('patient/patient.note') }}}</th>
				<th class="col-md-2">{{{ Lang::get('patient/patient.role') }}}</th>
			</tr>
		</thead>
		<tbody>
			@foreach($patient as $data)
			<tr>
				<td>
					<a  data-toggle="modal" data-target="#patient-modal" 
					data-profilename="{{ $data->first_name }} {{ $data->last_name }}"
					data-username="{{ $data->username }}" 
					data-firstname="{{ $data->first_name }}" 
					data-lastname="{{ $data->last_name }}"
					data-address="{{ $data->address }}"
					data-email="{{ $data->email }}"
					data-tel="{{ $data->tel }}"
					>{{ $data->username }}</a>
				</td>
				<td>
					{{ $data->first_name }} {{ $data->last_name }}
				</td>
				<td>
					<!-- Count of Notes -->
				</td>
				<td>
					{{ $data->role_name }}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

	<!-- Patient Modal -->
	<div class="modal fade bs-example-modal-lg" id="patient-modal" tabindex="-1" role="dialog" aria-labelledby="patient-modalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title" id="patient-modalLabel">New message</h4>
	      </div>

	      <div role="tabpanel">
	       	<ul class="nav nav-tabs" role="tablist">
			    <li role="presentation" class="active"><a href="#tab-profile" aria-controls="tab-profile" role="tab" data-toggle="tab">Profile</a></li>
			    <li role="presentation"><a href="#tab-note" aria-controls="tab-note" role="tab" data-toggle="tab">Note</a></li>
		  	</ul>

		  	<div class="tab-content">
		  		<div role="tabpanel" class="tab-pane active" id="tab-profile">
		      		<div class="modal-body">
		        		<form role="form">
			         		<div class="form-group">
			            		<label for="username" class="control-label">Username:</label>
			           			<input type="text" class="form-control" id="username">
			         		</div>
			          		<div class="form-group">
			            		<label for="patient-firstname" class="control-label">First Name:</label>
			            		<input type="text" class="form-control" id="patient-firstname"></input>
			          		</div>
			          		<div class="form-group">
			            		<label for="patient-lastname" class="control-label">Last Name:</label>
			            		<input type="text" class="form-control" id="patient-lastname"></input>
			          		</div>
		  	          		<div class="form-group">
			           		 	<label for="email" class="control-label">E-mail:</label>
			            		<input type="text" class="form-control" id="email"></input>
			          		</div>
		  	          		<div class="form-group">
			            		<label for="address" class="control-label">Address:</label>
			            		<input type="text" class="form-control" id="address"></input>
			          		</div>
		  	          		<div class="form-group">
			            		<label for="tel" class="control-label">Tel.:</label>
			            		<input type="text" class="form-control" id="tel"></input>
			          		</div>
		        		</form>
		      		</div>
		      		<div class="modal-footer">
		        		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        		<button type="button" class="btn btn-primary">Save</button>
		      		</div>
	      		</div>
	      		<div role="tabpanel" class="tab-pane" id="tab-note">
	      			<div class="modal-body">
		      			<form role="form">
		  	          		<div class="form-group">
			            		<label for="note" class="control-label">Note:</label>
			            		<textarea type="text" class="form-control" id="note"></textarea>
			          		</div>
			          	</form>
		          </div>
	      		</div>
	  		</div>
	    </div>
	    <div>
	  </div>
	</div>

@stop

{{-- Scripts --}}
@section('scripts')
	<script type="text/javascript">
		var oTable;
		$(document).ready(function() {
			$('#patient-modal').on('show.bs.modal', function (event) {
				  var button = $(event.relatedTarget) // Button that triggered the modal
				  var profilename = button.data('profilename');
				  var username = button.data('username') // Extract info from data-* attributes
				  var first_name = button.data('firstname');
				  var last_name = button.data('lastname');
				  var address = button.data('address');
				  var email = button.data('email');
				  var tel = button.data('tel');
				  var note = button.data('note');
				  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
				  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
				  var modal = $(this)
				  modal.find('.modal-title').text('Profile (' + profilename +')')
				  modal.find('.modal-body input').val(username)
				  modal.find('#patient-firstname').val(first_name);
				  modal.find('#patient-lastname').val(last_name);
				  modal.find('#address').val(address);
				  modal.find('#email').val(email);
				  modal.find('#tel').val(tel);
				  modal.find('#note').val(note);
				});
			});
	</script>
@stop
