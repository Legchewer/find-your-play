@extends('layouts.admin.master')

@section('content')

<div class="content members">
    <div class="row">
        <div class="large-12 columns content-header">

            <h1><i class="fa fa-users"></i> {{ Lang::choice('admin-pages.members', 1) }} <small>{{ Lang::get('admin-forms.member-create-title') }}</small></h1>

        </div>
    </div>

    <div class="row">
        <div class="large-12 columns content create">

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

            {{ Form::open(['route' => 'admin.members.store']), PHP_EOL }}

            {{ Form::label('person_email', ucfirst(Lang::get('admin-forms.person-email'))) }}
            <i class="fa fa-asterisk"></i>
            {{ Form::email('person_email', '', ['placeholder' => Lang::get('admin-forms.person-email-ph')]) }}

            {{ Form::label('givenname', ucfirst(Lang::get('admin-forms.person-givenname'))) }}
            <i class="fa fa-asterisk"></i>
            {{ Form::text('givenname', '', ['placeholder' => Lang::get('admin-forms.person-givenname-ph')]) }}

            {{ Form::label('surname', ucfirst(Lang::get('admin-forms.person-surname'))) }}
            <i class="fa fa-asterisk"></i>
            {{ Form::text('surname', '', ['placeholder' => Lang::get('admin-forms.person-surname-ph')]) }}

            {{ Form::label('password', ucfirst(Lang::get('admin-forms.member-password'))) }}
            <i class="fa fa-asterisk"></i>
            {{ Form::password('password', '', ['placeholder' => Lang::get('admin-forms.member-password-ph')]) }}

            {{ Form::label('repeat', ucfirst(Lang::get('admin-forms.member-repeat'))) }}
            <i class="fa fa-asterisk"></i>
            {{ Form::password('repeat', '', ['placeholder' => Lang::get('admin-forms.member-repeat-ph')]) }}

            {{ Form::submit(Lang::get('admin-forms.submit-add'), ['class' => 'button button-submit']), PHP_EOL }}
            {{ HTML::link('/admin/members', Lang::get('admin-forms.member-list'), ['' => '']), PHP_EOL }}
            {{ Form::close(), PHP_EOL }}

        </div>
    </div>
</div>


@stop