@extends('layouts.admin.login_master')

@section('content')

<h1>Login</h1>

<div class="large-12 columns login">

    @if ($errors->any())
    <div class="alert-box alert" data-alert>
        <ul class="no-bullet">
            @foreach ($errors->all('<li>:message</li>' . PHP_EOL) as $message)
            {{ $message }}
            @endforeach
        </ul>
        <a href="#" class="close">&times;</a>
    </div>
    @endif

    @if(Session::has('auth-error-message'))
    <div class="alert-box alert" data-alert>
        <span class="alert-msg">{{ Session::get('auth-error-message') }}</span>
        <a href="#" class="close">&times;</a>
    </div>
    @endif

    {{ Form::open(['route' => 'admin.auth', 'class' => 'login-form']), PHP_EOL }}

    {{ Form::email('email', '', ['placeholder' => 'Email address']) }}

    {{ Form::password('password', ['placeholder' => 'Password']) }}

    <div class="checkboxFive">
        <input type="checkbox" value="1" id="checkboxFiveInput" name="remember" />
        <label for="checkboxFiveInput"></label>
    </div>

    {{ Form::label('remember', 'Remember me', ['class' => 'inline left']); }}

    {{ Form::submit('Enter', ['class' => 'button expand']), PHP_EOL }}
    {{ Form::close(), PHP_EOL }}

</div>

@stop