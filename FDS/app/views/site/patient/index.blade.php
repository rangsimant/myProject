@extends('site.layouts.default')
@include('site.patient.modal')

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
	@yield('patient')

	<!-- Confirm Modal -->
	@yield('confirm')
@stop

{{-- Scripts --}}
@section('scripts')
	<script type="text/javascript">
		$(document).ready(function() {
			var form_profile = $('#form-profile');
			validateInput(form_profile);

			$('#note').wysihtml5();
			$('#patient').DataTable();
			$.fn.editable.defaults.mode = 'inline';
			
			patientModalOpen();
			updateProfile();
			saveNote();
			deleteNote();
			showConfirm();
			patientModalClose();
		});
	</script>
@stop
