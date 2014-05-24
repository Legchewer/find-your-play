@extends('layouts.admin.master')

@section('content')

<div class="content difficulties">
    <div class="row">
        <div class="large-12 columns content-header">

            <h1><i class="fa fa-bar-chart-o"></i> {{ Lang::choice('admin-pages.difficulties', 1) }} <small>Edit {{ strtolower(Lang::choice('admin-pages.difficulties', 0)) }}</small></h1>

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

            {{ Form::open(['route' => ['admin.difficulties.update', $difficulty->game_difficulty_id]]), PHP_EOL }}

            {{ Form::label('name_nl', ucfirst(Lang::get('admin-forms.difficulty-name-nl'))) }}
            <i class="fa fa-asterisk"> {{ Lang::get('admin-forms.one-language') }}</i>
            {{ Form::text('name_nl', $difficulty->game_difficulty_name_nl, ['placeholder' => Lang::get('admin-forms.difficulty-name-ph')]) }}

            {{ Form::label('name_en', ucfirst(Lang::get('admin-forms.difficulty-name-en'))) }}
            <i class="fa fa-asterisk"> {{ Lang::get('admin-forms.one-language') }}</i>
            {{ Form::text('name_en', $difficulty->game_difficulty_name_en, ['placeholder' => Lang::get('admin-forms.difficulty-name-ph')]) }}

            {{ Form::submit(Lang::get('admin-forms.submit-update'), ['class' => 'button button-submit']), PHP_EOL }}
            {{ HTML::link('/admin/difficulties', Lang::get('admin-forms.difficulty-list'), ['' => '']), PHP_EOL }}
            {{ Form::close(), PHP_EOL }}

        </div>
    </div>
</div>


@stop