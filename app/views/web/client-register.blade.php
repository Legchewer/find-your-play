@extends('layouts.web.master')

@section('content')
<div class="row breadcrumb">
    <div class="small-12 columns paddingfix">
        <ul class="breadcrumbs">
            <li><a href="{{ URL::to('/')}}">Home</a></li>
            <li><a href="{{ URL::to('web/user/profile') }}">{{ Lang::get('web-profiel.breadcrumb')}}</a></li>
            <li class="current">Client</li>
        </ul>
    </div>
</div>
<div id="profiel">
    <div class="row">
        <div class="small-12 columns">
            <h2>{{ Lang::get('web-client.title')}}</h2>
            {{ Form::open(['route' => 'web.register.client']), PHP_EOL }}

            {{ Form::label('givenname', Lang::get('web-profiel.form-firstname'),['class' => ($errors->has('givenname') ? 'error' : '' )])}}
            {{ Form::text('givenname', '',['class' => ($errors->has('givenname') ? 'error' : '' )]) }}
            @if ($errors->has('givenname'))
            {{ $errors->first('givenname', '<small class="error">:message</small>') }}
            @endif

            {{ Form::label('surname', Lang::get('web-profiel.form-lastname'),['class' => ($errors->has('surname') ? 'error' : '' ),])}}
            {{ Form::text('surname', '',['class' => ($errors->has('givenname') ? 'error' : '' )]) }}
            @if ($errors->has('surname'))
            {{ $errors->first('surname', '<small class="error">:message</small>') }}
            @endif

            {{ Form::label('email', Lang::get('web-profiel.form-email'),['class' => ($errors->has('email') ? 'error' : '' ),])}}
            {{ Form::email('email', '',['class' => ($errors->has('email') ? 'error' : '' )]) }}
            @if ($errors->has('email'))
            {{ $errors->first('email', '<small class="error">:message</small>') }}
            @endif

            {{ Form::label('experience', Lang::get('web-client.description'))}}
            {{ Form::textarea('experience') }}

            {{ Form::submit(Lang::get('web-client.button'), ['class' => 'button tiny']), PHP_EOL }}

            {{ Form::close(), PHP_EOL }}
        </div>
    </div>
    <br/>
    <div class="row">

    </div>
</div>
@stop