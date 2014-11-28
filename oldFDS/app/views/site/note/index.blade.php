@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ $title }}} :: @parent
@stop

@section('keywords')notes administration @stop
@section('author')Laravel 4 Bootstrap Starter SIte @stop
@section('description')notes administration index @stop

{{-- Content --}}
@section('content')
	<div class="page-header">
		<h3>
			{{{ $title }}}
		</h3>
	</div>

	<table id="notes" class="table table-striped table-hover">
		<thead>
			<tr>
				<th class="col-md-2">{{{ Lang::get('note/note.username') }}}</th>
				<th class="col-md-2">{{{ Lang::get('note/note.name') }}}</th>
				<th class="col-md-2">{{{ Lang::get('note/note.note') }}}</th>
				<th class="col-md-2">{{{ Lang::get('note/note.author') }}}</th>
				<th class="col-md-2">{{{ Lang::get('note/note.created_at') }}}</th>
				<th class="col-md-2">{{{ Lang::get('table.actions') }}}</th>
			</tr>
		</thead>
		<tbody>
				@foreach ($user as $users)
					<tr>
						<td>
							{{ $users->username }}
						</td>
						<td>
							{{ $users->first_name  }} {{ $users->last_name }}
						</td>
						<td>
							{{ $users->note }}
						</td>
						<td>
							{{ $users->author }}
						</td>
					</tr>
				@endforeach
		</tbody>
	</table>
@stop

{{-- Scripts --}}
@section('scripts')
	<script type="text/javascript">
		var oTable;
		$(document).ready(function() {
			oTable = $('#notes').dataTable( {
				"sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
				"sPaginationType": "bootstrap",
				"oLanguage": {
					"sLengthMenu": "_MENU_ records per page"
				},
				"bProcessing": true,
		        "bServerSide": true,
		        "sAjaxSource": "{{ URL::to('site/note/data') }}",
		        "fnDrawCallback": function ( oSettings ) {
	           		$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
	     		}
			});

		});
	</script>
@stop