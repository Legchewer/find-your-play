@extends('layouts.admin.master')

@section('content')

<div class="content budgetgroups">
    <div class="row">
        <div class="large-12 columns content-header">

            <h1><i class="fa fa-money"></i> {{ Lang::choice('admin-pages.budget-groups', 1) }} <small>Edit {{ strtolower(Lang::choice('admin-pages.budget-groups', 0)) }}</small></h1>

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

            {{ Form::open(['route' => ['admin.budgetgroups.update', $budgetgroup->budget_group_id]]), PHP_EOL }}

            {{ Form::label('value', ucfirst(Lang::get('admin-forms.budgetgroup-value'))) }}
            <i class="fa fa-asterisk"></i>
            {{ Form::text('value', $budgetgroup->budget_group_value, ['placeholder' => Lang::get('admin-forms.budgetgroup-value-ph')]) }}

            {{ Form::submit(Lang::get('admin-forms.submit-update'), ['class' => 'button button-submit']), PHP_EOL }}
            {{ HTML::link('/admin/budget-groups', Lang::get('admin-forms.budgetgroup-list'), ['' => '']), PHP_EOL }}
            {{ Form::close(), PHP_EOL }}

        </div>
    </div>
</div>


@stop