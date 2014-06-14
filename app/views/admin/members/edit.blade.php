@extends('layouts.admin.master')

@section('content')

<div class="content members">
    <div class="row">
        <div class="large-12 columns content-header">

            <h1><i class="fa fa-users"></i> {{ Lang::choice('admin-pages.members', 1) }} <small>Edit {{ strtolower(Lang::choice('admin-pages.members', 0)) }}</small></h1>

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

            {{ Form::open(['route' => ['admin.members.update', $member->member_id]]), PHP_EOL }}

            {{ Form::label('person_email', ucfirst(Lang::get('admin-forms.person-email'))) }}
            <i class="fa fa-asterisk"></i>
            {{ Form::email('person_email', $member->person->person_email, ['placeholder' => Lang::get('admin-forms.person-email-ph')]) }}

            {{ Form::label('givenname', ucfirst(Lang::get('admin-forms.person-givenname'))) }}
            <i class="fa fa-asterisk"></i>
            {{ Form::text('givenname', $member->person->person_givenname, ['placeholder' => Lang::get('admin-forms.person-givenname-ph')]) }}

            {{ Form::label('surname', ucfirst(Lang::get('admin-forms.person-surname'))) }}
            <i class="fa fa-asterisk"></i>
            {{ Form::text('surname', $member->person->person_surname, ['placeholder' => Lang::get('admin-forms.person-surname-ph')]) }}

            {{ Form::submit(Lang::get('admin-forms.submit-update'), ['class' => 'button button-submit']), PHP_EOL }}
            {{ HTML::link('/admin/members', Lang::get('admin-forms.member-list'), ['' => '']), PHP_EOL }}
            {{ Form::close(), PHP_EOL }}

        </div>
    </div>
</div>


@stop