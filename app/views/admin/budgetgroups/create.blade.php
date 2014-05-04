@extends('layouts.admin.master')

@section('content')

<div class="content budgetgroups">
    <div class="row">
        <div class="large-12 columns content-header">

            <h1><i class="fa fa-money"></i> {{ Lang::choice('admin-pages.budget-groups', 1) }} <small>{{ Lang::get('admin-forms.budgetgroup-create-title') }}</small></h1>

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

            {{ Form::open(['route' => 'admin.budgetgroups.store']), PHP_EOL }}

            {{ Form::label('value', ucfirst(Lang::get('admin-forms.budgetgroup-value'))) }}
            <i class="fa fa-asterisk"></i>
            {{ Form::text('value', '', ['placeholder' => Lang::get('admin-forms.budgetgroup-value-ph')]) }}

            {{ Form::submit(Lang::get('admin-forms.submit-add'), ['class' => 'button button-submit']), PHP_EOL }}
            {{ HTML::link('/admin/budgetgroups', Lang::get('admin-forms.budgetgroup-list'), ['' => '']), PHP_EOL }}
            {{ Form::close(), PHP_EOL }}

        </div>
    </div>
</div>


@stop