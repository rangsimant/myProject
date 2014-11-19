@extends('site.layouts.default')

{{-- Content --}}
@section('content')
	<!-- Tabs -->
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab-profile" data-toggle="tab">Profile</a></li>
		</ul>
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab-note" data-toggle="tab">Note</a></li>
		</ul>
	<!-- ./ tabs -->
	{{-- Edit Blog Comment Form --}}
	<form class="form-horizontal" method="post" action="" autocomplete="off">
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		<!-- ./ csrf token -->

		<!-- Tabs Content -->
		<div class="tab-content">
			<!-- General tab -->
			<div class="tab-pane active" id="tab-profile">

				<!-- Content -->
				<div class="form-group {{{ $errors->has('content') ? 'error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="content">Content</label>
						{{ $errors->first('content', '<span class="help-inline">:message</span>') }}
					</div>
				</div>
				<!-- ./ content -->
			</div>
			<!-- ./ general tab -->

					<!-- Note tab -->
			<div class="tab-pane active" id="tab-note">

				<!-- Content -->
				<div class="form-group {{{ $errors->has('content') ? 'error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="content">Content</label>
						{{ $errors->first('content', '<span class="help-inline">:message</span>') }}
					</div>
				</div>
				<!-- ./ content -->
			</div>
			<!-- ./ Note tab -->

		</div>
		<!-- ./ tabs content -->

		<!-- Form Actions -->
		<div class="form-group">
			<div class="col-md-12">
				<element class="btn-cancel close_popup">Cancel</element>
				<button type="reset" class="btn btn-default">Reset</button>
				<button type="submit" class="btn btn-success">Update</button>
			</div>
		</div>
		<!-- ./ form actions -->
	</form>
@stop
