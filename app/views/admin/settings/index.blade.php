@extends('layouts.admin.master')

@section('content')

<div class="content settings">
    <div class="row">
        <div class="large-12 columns content-header">

            <h1><i class="fa fa-cogs"></i> {{ Lang::choice('admin-pages.settings',1) }} <small>{{ Lang::get('admin-pages.settings-sub') }}</small></h1>

        </div>
    </div>

    <div class="row">
        <div class="large-12 columns content">

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

            {{-- LANGUAGE CHECK --}}
            @if (App::getLocale() == 'nl')

                <p>Selecteer welke talen in de front-end geactiveerd zijn.</p>

                {{ Form::open(['route' => ['admin.settings.update']]), PHP_EOL }}

                <div class="lang-wrapper">
                    {{ Form::label('lang_nl', $settings[0]->setting_name_nl . ':') }}
                    {{ Form::checkbox('lang_nl', $settings[0]->setting_name_nl, $settings[0]->setting_value_nl) }}
                </div>

                <div class="lang-wrapper">
                    {{ Form::label('lang_en', $settings[1]->setting_name_nl . ':') }}
                    {{ Form::checkbox('lang_en', $settings[1]->setting_name_nl, $settings[1]->setting_value_nl) }}
                </div>

                {{ Form::submit(Lang::get('admin-forms.submit-update'), ['class' => 'button settings']), PHP_EOL }}
                {{ Form::close(), PHP_EOL }}

            @else

                <p>Select which languages are enabled in the front-end.</p>

                {{ Form::open(['route' => ['admin.settings.update']]), PHP_EOL }}

                <div class="lang-wrapper">

                    {{ Form::label('lang_en', $settings[0]->setting_name_en . ':') }}
                    {{ Form::checkbox('lang_en', $settings[0]->setting_name_en, $settings[0]->setting_value_en) }}
                </div>

                <div class="lang-wrapper">
                    {{ Form::label('lang_en', $settings[1]->setting_name_en . ':') }}
                    {{ Form::checkbox('lang_en', $settings[1]->setting_name_en, $settings[1]->setting_value_en) }}
                </div>

                {{ Form::submit(Lang::get('admin-forms.submit-update'), ['class' => 'button settings']), PHP_EOL }}
                {{ Form::close(), PHP_EOL }}

            @endif

        </div>
    </div>
</div>

@stop