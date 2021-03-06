@extends('layouts.admin.master')

@section('content')

<div class="content categories">
    <div class="row">
        <div class="large-12 columns content-header">

            <h1><i class="fa fa-book"></i> {{ Lang::choice('admin-pages.function-categories', 1) }} <small>{{ Lang::get('admin-forms.category-create-title') }}</small></h1>

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

            {{ Form::open(['route' => 'admin.categories.store']), PHP_EOL }}

            {{ Form::label('name_nl', ucfirst(Lang::get('admin-forms.category-name-nl'))) }}
            <i class="fa fa-asterisk"> {{ Lang::get('admin-forms.one-language') }}</i>
            {{ Form::text('name_nl', '', ['placeholder' => Lang::get('admin-forms.category-name-ph')]) }}

            {{ Form::label('name_en', ucfirst(Lang::get('admin-forms.category-name-en'))) }}
            <i class="fa fa-asterisk"> {{ Lang::get('admin-forms.one-language') }}</i>
            {{ Form::text('name_en', '', ['placeholder' => Lang::get('admin-forms.category-name-ph')]) }}

            {{ Form::submit(Lang::get('admin-forms.submit-add'), ['class' => 'button button-submit']), PHP_EOL }}
            {{ HTML::link('/admin/categories', Lang::get('admin-forms.category-list'), ['' => '']), PHP_EOL }}
            {{ Form::close(), PHP_EOL }}

        </div>
    </div>
</div>


@stop