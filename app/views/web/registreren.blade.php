@extends('layouts.web.master')

@section('content')
<div class="row breadcrumb">
    <div class="small-12 columns">
        <ul class="breadcrumbs">
            <li><a href="{{ URL::to('web/index')}}">Home</a></li>
            <li class="unactive">Gebruiker</li>
            <li class="current">Registreren</li>
        </ul>
    </div>
</div>
<div id="registreren">
    {{ Form::open(['route' => 'web.register']), PHP_EOL }}

    {{ Form::label('givenname', Lang::get('validation.attributes.givenname'),['class' => ($errors->has('givenname') ? 'error' : '' )])}}
    {{ Form::text('givenname', '',['class' => ($errors->has('givenname') ? 'error' : '' )]) }}
    @if ($errors->has('givenname'))
    {{ $errors->first('givenname', '<small class="error">:message</small>') }}
    @endif

    {{ Form::label('surname', Lang::get('validation.attributes.surname'),['class' => ($errors->has('surname') ? 'error' : '' ),])}}
    {{ Form::text('surname', '',['class' => ($errors->has('givenname') ? 'error' : '' )]) }}
    @if ($errors->has('surname'))
    {{ $errors->first('surname', '<small class="error">:message</small>') }}
    @endif

    {{ Form::label('email', Lang::get('validation.attributes.email'),['class' => ($errors->has('email') ? 'error' : '' ),])}}
    {{ Form::email('email', '',['class' => ($errors->has('email') ? 'error' : '' )]) }}
    @if ($errors->has('email'))
    {{ $errors->first('email', '<small class="error">:message</small>') }}
    @endif

    {{ Form::label('password',Lang::get('validation.attributes.password') . ':', ['class' => ($errors->has('password') ? 'error' : '' ),])}}
    {{ Form::password('password', ['class' => ($errors->has('password') ? 'error' : '' )])}}
    @if ($errors->has('password'))
    {{ $errors->first('password', '<small class="error">:message</small>') }}
    @endif

    {{ Form::label('password_repeat',Lang::get('validation.attributes.password_repeat') . ':', ['class' => ($errors->has('password_repeat') ? 'error' : '' ),])}}
    {{ Form::password('password_repeat', ['class' => ($errors->has('password_repeat') ? 'error' : '' )])}}
    @if ($errors->has('password_repeat'))
    {{ $errors->first('password_repeat', '<small class="error">:message</small>') }}
    @endif

    {{ Form::label('role',Lang::get('validation.attributes.role'), ['class' => ($errors->has('role') ? 'error' : '' ),])}}
    {{ Form::select('role', ['' => '-- Maak uw keuze --'] + $roles)}}

    {{ Form::submit('Registreren', ['class' => 'button tiny']), PHP_EOL }}

    {{ Form::close(), PHP_EOL }}
</div>
@stop