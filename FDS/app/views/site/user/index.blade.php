@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ Lang::get('user/user.settings') }}} ::
@parent
@stop

{{-- New Laravel 4 Feature in use --}}
@section('styles')
@parent
body {
	background: #f2f2f2;
}
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
	<h3>Edit your settings</h3>
</div>
<form id="form" data-toggle="validator" class="form-horizontal" method="post" action="{{ URL::to('user/' . $user->id . '/edit') }}"  autocomplete="off">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <!-- ./ csrf token -->
    <!-- General tab -->
    <div class="tab-pane active" id="tab-general">
        <!-- username -->
        <div class="form-group {{{ $errors->has('username') ? 'error' : '' }}}">
            <label class="col-md-2 control-label" for="username">Username</label>
            <div class="col-md-10">
                <input class="form-control" type="text" name="username" id="username" value="{{{ Input::old('username', $user->username) }}}" READONLY/>
                {{ $errors->first('username', '<span class="help-inline">:message</span>') }}
            </div>
        </div>
        <!-- ./ username -->

        <!-- Email -->
        <div class="form-group {{{ $errors->has('email') ? 'error' : '' }}}">
            <label class="col-md-2 control-label" for="email">Email</label>
            <div class="email col-md-10">
                <input class="form-control" type="text" name="email" id="email" value="{{{ Input::old('email', $user->email) }}}"/>
                {{ $errors->first('email', '<span class="help-inline">:message</span>') }}
                <span id="validEmail" class="" aria-hidden="true"></span>
            </div>
        </div>
        <!-- ./ email -->

        <!-- Password -->
        <div class="form-group {{{ $errors->has('password') ? 'error' : '' }}}">
            <label class="col-md-2 control-label" for="password">Password</label>
            <div class="col-md-10">
                <input class="form-control" type="password" name="password" id="password" value="" />
                {{ $errors->first('password', '<span class="help-inline">:message</span>') }}
            </div>
        </div>
        <!-- ./ password -->

        <!-- Password Confirm -->
        <div class="form-group {{{ $errors->has('password_confirmation') ? 'error' : '' }}}">
            <label class="col-md-2 control-label" for="password_confirmation">Password Confirm</label>
            <div class="password col-md-10">
                <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" value="" />
                {{ $errors->first('password_confirmation', '<span class="help-inline">:message</span>') }}
                <span id="validPassword" class="" aria-hidden="true"></span>
            </div>
        </div>
        <!-- ./ password confirm -->

        <!-- first_name -->
        <div class="form-group {{{ $errors->has('first_name') ? 'error' : '' }}}">
            <label class="col-md-2 control-label" for="first_name">First name</label>
            <div class="col-md-10">
                <input class="form-control" type="text" name="first_name" id="first_name" value="{{{ Input::old('first_name',$profile->first_name)}}}" />
                {{ $errors->first('first_name', '<span class="help-inline">:message</span>') }}
            </div>
        </div>
        <!-- ./ first_name -->

        <!-- last_name -->
        <div class="form-group {{{ $errors->has('last_name') ? 'error' : '' }}}">
            <label class="col-md-2 control-label" for="last_name">Last name</label>
            <div class="col-md-10">
                <input class="form-control" type="text" name="last_name" id="last_name" value="{{{ Input::old('last_name',$profile->last_name)}}}" />
                {{ $errors->first('last_name', '<span class="help-inline">:message</span>') }}
            </div>
        </div>
        <!-- ./ last_name -->

        <!-- address -->
        <div class="form-group {{{ $errors->has('address') ? 'error' : '' }}}">
            <label class="col-md-2 control-label" for="address">Address</label>
            <div class="col-md-10">
                <input class="form-control" type="text" name="address" id="address" value="{{{ Input::old('address',$profile->address)}}}" />
                {{ $errors->first('address', '<span class="help-inline">:message</span>') }}
            </div>
        </div>
        <!-- ./ address -->

        <!-- tel -->
        <div class="form-group {{{ $errors->has('tel') ? 'error' : '' }}}">
            <label class="col-md-2 control-label" for="tel">Telephone</label>
            <div class="col-md-10">
                <input class="form-control" type="text" name="tel" id="tel" value="{{{ Input::old('tel',$profile->tel)}}}" maxlength="10"/>
                {{ $errors->first('tel', '<span class="help-inline">:message</span>') }}
            </div>
        </div>
        <!-- ./ tel -->

    </div>
    <!-- ./ general tab -->

    <!-- Form Actions -->
    <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
            <button type="submit" class="btn btn-success">Update</button>
        </div>
    </div>
    <!-- ./ form actions -->
</form>
</form>
@stop

{{-- Scripts --}}
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#form').validator()
           validateInput('#email','#password','#password_confirmation');
        });
    </script>
@stop
