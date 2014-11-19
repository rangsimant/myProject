@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ Lang::get('user/user.register') }}} ::
@parent
@stop

{{-- Content --}}
@section('content')

<form id="form"  method="POST" action="{{{ (Confide::checkAction('UserController@store')) ?: URL::to('user')  }}}" accept-charset="UTF-8">
    <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
    <fieldset>
        <!-- User -->
        <div class="col-md-8 col-md-offset-3">
        	<div class="page-header col-md-10">
				<h1>Signup</h1>
			</div>
	        <div class="form-group col-md-10">
	            <label for="username">{{{ Lang::get('confide::confide.username') }}}</label>
	            <input class="form-control" placeholder="{{{ Lang::get('confide::confide.username') }}}" type="text" name="username" id="username" value="{{{ Input::old('username') }}}">
	        </div>
	        <div class="form-group col-md-10">
	            <label for="email">{{{ Lang::get('confide::confide.e_mail') }}} <small>{{ Lang::get('confide::confide.signup.confirmation_required') }} </small>
	            	<span name="valid-email" id="valid-email">

	            	</span>
	            </label>
	            <input class="form-control" placeholder="{{{ Lang::get('confide::confide.e_mail') }}}" type="text" name="email" id="email" value="{{{ Input::old('email') }}}">
	        </div>
	        <div class="form-group col-md-5">
	            <label for="password">{{{ Lang::get('confide::confide.password') }}}</label>
	            <input class="form-control" placeholder="{{{ Lang::get('confide::confide.password') }}}" type="password" name="password" id="password">
	        </div>
	        <div class="form-group col-md-5">
	            <label for="password_confirmation">{{{ Lang::get('confide::confide.password_confirmation') }}} <span id="valid-password"></span></label>
	            <input class="form-control" placeholder="{{{ Lang::get('confide::confide.password_confirmation') }}}" type="password" name="password_confirmation" id="password_confirmation">
	        </div>
	        <div class="form-group col-md-5">
	            <label for="password_confirmation">{{{ Lang::get('signup.first_name') }}}</label>
	            <input class="form-control" placeholder="{{{ Lang::get('signup.first_name') }}}" type="text" name="first_name" id="first_name" value="{{{ Input::old('first_name') }}}" >
	        </div>
	        <div class="form-group col-md-5">
	            <label for="password_confirmation">{{{ Lang::get('signup.last_name') }}}</label>
	            <input class="form-control" placeholder="{{{ Lang::get('signup.last_name') }}}" type="text" name="last_name" id="last_name" value="{{{ Input::old('last_name') }}}">
	        </div>


	        @if ( Session::get('notice') )
	            <div class="alert">{{ Session::get('notice') }}</div>
	        @endif

	        <div class="form-actions form-group col-md-10 text-right">
	          <button type="submit" class="btn btn-primary" disabled="disabled">{{{ Lang::get('confide::confide.signup.submit') }}}</button>
	        </div>
		</div>
    </fieldset>
</form>

@stop

{{-- Scripts --}}
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
           validateInput('#email','#password','#password_confirmation');
        });
    </script>
@stop
