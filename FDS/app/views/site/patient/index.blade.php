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
			<tr 
			@if (Auth::check())
				@if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('comment')) // if current user has 'Admin' Role 
					data-toggle="modal" 
					data-target="#patient-modal" 
					data-userid="{{ $data->user_id }}"
					data-authorid="{{{ Auth::user()->id }}}"
				@endif
			@endif
				>
				<td>
					{{ $data->username }}
				</td>
				<td>
					{{ $data->first_name }} {{ $data->last_name }}
				</td>
				<td>
					{{ $data->countnote }}
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
	  <div class="modal-dialog modal-lg">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title" id="patient-modalLabel">New message</h4>
	      	</div>
		      	<div role="tabpanel">
			       	<ul class="nav nav-tabs" role="tablist">
						@if (Auth::check())
	                        @if (Auth::user()->hasRole('admin'))
        		      			<?php $profile_active = 'active'; ?>
	    		      			<?php $note_active = ''; ?>
					    		<li role="presentation" class="{{ $profile_active }}"><a href="#tab-profile" aria-controls="tab-profile" role="tab" data-toggle="tab">Profile</a></li>
	    		      		@else
	    		      			<?php $note_active = 'active'; ?>
	    		      			<?php $profile_active = ''; ?>
	    		      		@endif

					    <li role="presentation" class="{{ $note_active }}"><a href="#tab-note" aria-controls="tab-note" role="tab" data-toggle="tab">Note</a></li>
				  	</ul>
				  	<div class="tab-content">

				  		<!-- tab Profile -->
				  		<div role="tabpanel" class="tab-pane {{ $profile_active }}" id="tab-profile">
				      		<div class="modal-body">
				        		<form role="form">
					         		<div class="form-group">
					            		<label for="username" class="control-label">Username:</label>
					           			<input type="text" class="form-control" id="username" readonly>
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
			      		@endif
	
			      		<!-- tab Note -->
			      		<div role="tabpanel" class="tab-pane {{ $note_active }}" id="tab-note">
			      			{{ Form::open( array(
							    'route' => 'patient.create',
							    'method' => 'post',
							    'id' => 'form-note'
							) ) }}
 							<div class="modal-body">
 								<div class='panel-group' id='accordion' role='tablist' aria-multiselectable='true'>

 								</div>
							</div>
						<div class="modal-footer">
							<div class="form-group">
								{{ Form::label( 'lbnote', 'Note:',array(
									'class'=>'left'
								) ) }}
								{{ Form::textarea( 'note', '', array(
								    'id' => 'note',
								    'placeholder' => 'Note..',
								    'required' => true,
								    'class' => 'form-control'
								) ) }}

								{{ Form::submit( 'Save', array(
								    'id' => 'save_note',
								    'class' => 'btn btn-primary'
								) ) }}
								 
								{{ Form::close() }}
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
		$(document).ready(function() {
			showDataOnModal();
			saveNote();
		});
	</script>
@stop
