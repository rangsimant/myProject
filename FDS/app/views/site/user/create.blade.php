@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ Lang::get('user/user.register') }}} ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
	<h1>Signup</h1>
</div>
<form method="POST" action="{{{ (Confide::checkAction('UserController@store')) ?: URL::to('user')  }}}" accept-charset="UTF-8">
    <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
    <fieldset>
        <!-- User -->
        <div class="form-group">
            <label for="username">{{{ Lang::get('confide::confide.username') }}}</label>
            <input class="form-control" placeholder="{{{ Lang::get('confide::confide.username') }}}" type="text" name="username" id="username" value="{{{ Input::old('username') }}}">
        </div>
        <div class="form-group">
            <label for="email">{{{ Lang::get('confide::confide.e_mail') }}} <small>{{ Lang::get('confide::confide.signup.confirmation_required') }}</small></label>
            <input class="form-control" placeholder="{{{ Lang::get('confide::confide.e_mail') }}}" type="text" name="email" id="email" value="{{{ Input::old('email') }}}">
        </div>
        <div class="form-group">
            <label for="password">{{{ Lang::get('confide::confide.password') }}}</label>
            <input class="form-control" placeholder="{{{ Lang::get('confide::confide.password') }}}" type="password" name="password" id="password">
        </div>
        <div class="form-group">
            <label for="password_confirmation">{{{ Lang::get('confide::confide.password_confirmation') }}}</label>
            <input class="form-control" placeholder="{{{ Lang::get('confide::confide.password_confirmation') }}}" type="password" name="password_confirmation" id="password_confirmation">
        </div>

        <!-- Profile --> <!-- app\lang\en\signup.php -->
        <div class="form-group">
            <label for="password_confirmation">{{{ Lang::get('signup.first_name') }}}</label>
            <input class="form-control" placeholder="{{{ Lang::get('signup.first_name') }}}" type="text" name="first_name" id="first_name" value="{{{ Input::old('first_name') }}}" >
        </div>
        <div class="form-group">
            <label for="password_confirmation">{{{ Lang::get('signup.last_name') }}}</label>
            <input class="form-control" placeholder="{{{ Lang::get('signup.last_name') }}}" type="text" name="last_name" id="last_name" value="{{{ Input::old('last_name') }}}">
        </div>
        <div class="form-group">
            <label for="password_confirmation">{{{ Lang::get('signup.address') }}}</label>
            <input class="form-control" placeholder="{{{ Lang::get('signup.address') }}}" type="text" name="address" id="address" value="{{{ Input::old('address') }}}">
        </div>
        <div class="form-group">
            <label for="password_confirmation">{{{ Lang::get('signup.tel') }}}</label>
            <input class="form-control" placeholder="{{{ Lang::get('signup.tel') }}}" type="text" name="tel" id="tel" Maxlength="10" value="{{{ Input::old('tel') }}}">
        </div>



        @if ( Session::get('error') )
            <div class="alert alert-error alert-danger">
                @if ( is_array(Session::get('error')) )
                    {{ head(Session::get('error')) }}
                @endif
            </div>
        @endif

        @if ( Session::get('notice') )
            <div class="alert">{{ Session::get('notice') }}</div>
        @endif

        <div class="form-actions form-group">
          <button type="submit" class="btn btn-primary">{{{ Lang::get('confide::confide.signup.submit') }}}</button>
        </div>

    </fieldset>
</form>

@stop
