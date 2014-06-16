@extends('layouts.admin.master')

@section('content')

<div class="content members">
    <div class="row">
        <div class="large-12 columns content-header">

            <h1><i class="fa fa-users"></i> Change password</h1>

        </div>
    </div>

    <div class="row">
        <div class="large-12 columns content edit">

            @if ($errors->any())
            <div class="alert-box alert radius" data-alert>
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

            {{ Form::open(['route' => ['admin.members.pwupdate']]), PHP_EOL }}

            {{ Form::label('old_password', ucfirst(Lang::get('admin-forms.member-old-password'))) }}
            <i class="fa fa-asterisk"></i>
            {{ Form::password('old_password', '', []) }}

            {{ Form::label('old_repeat', ucfirst(Lang::get('admin-forms.member-old-repeat'))) }}
            <i class="fa fa-asterisk"></i>
            {{ Form::password('old_repeat', '', []) }}

            {{ Form::label('password', ucfirst(Lang::get('admin-forms.member-new-password'))) }}
            <i class="fa fa-asterisk"></i>
            {{ Form::password('password', '', []) }}

            {{ Form::label('repeat', ucfirst(Lang::get('admin-forms.member-repeat'))) }}
            <i class="fa fa-asterisk"></i>
            {{ Form::password('repeat', '', []) }}

            {{ Form::submit(Lang::get('admin-forms.submit-update'), ['class' => 'button button-submit']), PHP_EOL }}
            {{ HTML::link('/admin', Lang::get('admin-forms.return-dashboard'), ['' => '']), PHP_EOL }}
            {{ Form::close(), PHP_EOL }}

        </div>
    </div>
</div>


@stop