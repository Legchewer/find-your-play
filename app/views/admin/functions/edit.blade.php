@extends('layouts.admin.master')

@section('content')

<div class="content types">
    <div class="row">
        <div class="large-12 columns content-header">

            <h1><i class="fa fa-lightbulb-o"></i> {{ Lang::choice('admin-pages.functions', 1) }} <small>Edit {{ strtolower(Lang::choice('admin-pages.functions', 0)) }}</small></h1>

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

            {{ Form::open(['route' => ['admin.functions.update', $function->game_function_id]]), PHP_EOL }}

            {{ Form::label('category', ucfirst(Lang::get('admin-forms.function-category'))) }}
            <i class="fa fa-asterisk"></i>
            {{ Form::select('category', $categories, $function->gameFunctionCategory->game_function_category_id) }}

            {{ Form::label('name_nl', ucfirst(Lang::get('admin-forms.function-name-nl'))) }}
            <i class="fa fa-asterisk"> {{ Lang::get('admin-forms.one-language') }}</i>
            {{ Form::text('name_nl', $function->game_function_name_nl, ['placeholder' => Lang::get('admin-forms.function-name-ph')]) }}

            {{ Form::label('name_en', ucfirst(Lang::get('admin-forms.function-name-en'))) }}
            <i class="fa fa-asterisk"> {{ Lang::get('admin-forms.one-language') }}</i>
            {{ Form::text('name_en', $function->game_function_name_en, ['placeholder' => Lang::get('admin-forms.function-name-ph')]) }}

            {{ Form::submit(Lang::get('admin-forms.submit-update'), ['class' => 'button button-submit']), PHP_EOL }}
            {{ HTML::link('/admin/functions', Lang::get('admin-forms.function-list'), ['' => '']), PHP_EOL }}
            {{ Form::close(), PHP_EOL }}

        </div>
    </div>
</div>


@stop