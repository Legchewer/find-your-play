@extends('layouts.admin.master')

@section('content')

<div class="content types">
    <div class="row">
        <div class="large-12 columns content-header">

            <h1><i class="fa fa-folder-open"></i> {{ Lang::choice('admin-pages.types', 1) }} <small>Edit {{ strtolower(Lang::choice('admin-pages.types', 0)) }}</small></h1>

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

            {{ Form::open(['route' => ['admin.types.update', $type->game_type_id]]), PHP_EOL }}

            {{ Form::label('kind', ucfirst(Lang::get('admin-forms.type-kind'))) }}
            <i class="fa fa-asterisk"></i>
            {{ Form::select('kind', $kinds, $type->gameKind->game_kind_id) }}

            {{ Form::label('name_nl', ucfirst(Lang::get('admin-forms.type-name-nl'))) }}
            <i class="fa fa-asterisk"> {{ Lang::get('admin-forms.one-language') }}</i>
            {{ Form::text('name_nl', $type->game_type_name_nl, ['placeholder' => Lang::get('admin-forms.type-name-ph')]) }}

            {{ Form::label('name_en', ucfirst(Lang::get('admin-forms.type-name-en'))) }}
            <i class="fa fa-asterisk"> {{ Lang::get('admin-forms.one-language') }}</i>
            {{ Form::text('name_en', $type->game_type_name_en, ['placeholder' => Lang::get('admin-forms.type-name-ph')]) }}

            {{ Form::submit(Lang::get('admin-forms.submit-update'), ['class' => 'button button-submit']), PHP_EOL }}
            {{ HTML::link('/admin/types', Lang::get('admin-forms.type-list'), ['' => '']), PHP_EOL }}
            {{ Form::close(), PHP_EOL }}

        </div>
    </div>
</div>


@stop