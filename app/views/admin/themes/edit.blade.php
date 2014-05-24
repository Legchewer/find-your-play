@extends('layouts.admin.master')

@section('content')

<div class="content themes">
    <div class="row">
        <div class="large-12 columns content-header">

            <h1><i class="fa fa-rocket"></i> {{ Lang::choice('admin-pages.themes', 1) }} <small>Edit {{ strtolower(Lang::choice('admin-pages.themes', 0)) }}</small></h1>

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

            {{ Form::open(['route' => ['admin.themes.update', $theme->theme_id]]), PHP_EOL }}

            {{ Form::label('name_nl', ucfirst(Lang::get('admin-forms.theme-name-nl'))) }}
            <i class="fa fa-asterisk"> {{ Lang::get('admin-forms.one-language') }}</i>
            {{ Form::text('name_nl', $theme->theme_name_nl, ['placeholder' => Lang::get('admin-forms.theme-name-ph')]) }}

            {{ Form::label('name_en', ucfirst(Lang::get('admin-forms.theme-name-en'))) }}
            <i class="fa fa-asterisk"> {{ Lang::get('admin-forms.one-language') }}</i>
            {{ Form::text('name_en', $theme->theme_name_en, ['placeholder' => Lang::get('admin-forms.theme-name-ph')]) }}

            {{ Form::submit(Lang::get('admin-forms.submit-update'), ['class' => 'button button-submit']), PHP_EOL }}
            {{ HTML::link('/admin/themes', Lang::get('admin-forms.theme-list'), ['' => '']), PHP_EOL }}
            {{ Form::close(), PHP_EOL }}

        </div>
    </div>
</div>


@stop