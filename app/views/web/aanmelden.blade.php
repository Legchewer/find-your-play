@extends('layouts.web.master')

@section('content')
<div class="row breadcrumb">
    <div class="small-12 columns">
        <ul class="breadcrumbs">
            <li><a href="{{ URL::to('web/index')}}">Home</a></li>
            <li class="current">{{Lang::get('web-registreren.aanmelden')}}</li>
        </ul>
    </div>
</div>
<div id="registreren" class="row">
    <div class="small-12 columns">
        {{ Form::open(['route' => 'web.auth']), PHP_EOL }}

        {{ Form::email('email', '', ['placeholder' => Lang::get('web-index.login-email-placeholder'),'class' => ($errors->has('email') ? 'error' : '' )]) }}
        @if ($errors->has('email'))
        {{ $errors->first('email', '<small class="error">:message</small>') }}
        @endif

        {{ Form::password('password', ['placeholder' => Lang::get('web-index.login-password-placeholder'),'class' => ($errors->has('password') ? 'error' : '' )]) }}
        @if ($errors->has('password'))
        {{ $errors->first('password', '<small class="error">:message</small>') }}
        @endif

        {{ Form::submit(Lang::get('web-registreren.aanmelden'), ['class' => 'button tiny']), PHP_EOL }}</p>

        {{ Form::close(), PHP_EOL }}
    </div>
</div>
@stop