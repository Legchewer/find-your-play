@extends('layouts.admin.master')

@section('content')

<div class="content games">
    <div class="row">
        <div class="large-12 columns content-header">

            <h1><i class="fa fa-puzzle-piece"></i> {{ Lang::choice('admin-pages.games', 1) }} <small>{{ Lang::get('admin-forms.game-create-title') }}</small></h1>

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

            {{ Form::open(['route' => 'admin.games.store', 'files' => true]), PHP_EOL }}

            {{ Form::label('title_nl', ucfirst(Lang::get('admin-forms.game-title-nl'))) }}
            <i class="fa fa-asterisk"> {{ Lang::get('admin-forms.one-language') }}</i>
            {{ Form::text('title_nl', '', ['placeholder' => Lang::get('admin-forms.game-title-ph')]) }}

            {{ Form::label('title_en', ucfirst(Lang::get('admin-forms.game-title-en'))) }}
            <i class="fa fa-asterisk"> {{ Lang::get('admin-forms.one-language') }}</i>
            {{ Form::text('title_en', '', ['placeholder' => Lang::get('admin-forms.game-title-ph')]) }}

            {{ Form::label('type', ucfirst(Lang::get('admin-forms.game-type'))) }}
            {{ Form::select('type', $types) }}

            {{ Form::label('description_nl', ucfirst(Lang::get('admin-forms.game-description-nl'))) }}
            {{ Form::textarea('description_nl', '', ['class' => 'ckeditor','placeholder' => Lang::get('admin-forms.game-description-ph')]) }}

            {{ Form::label('description_en', ucfirst(Lang::get('admin-forms.game-description-en'))) }}
            {{ Form::textarea('description_en', '', ['class' => 'ckeditor','placeholder' => Lang::get('admin-forms.game-description-ph')]) }}

            {{ Form::label('difficulty', ucfirst(Lang::get('admin-forms.game-difficulty'))) }}
            <i class="fa fa-asterisk"></i>
            {{ Form::select('difficulty', $difficulties) }}

            {{ Form::label('age_nl', ucfirst(Lang::get('admin-forms.game-age-nl'))) }}
            {{ Form::text('age_nl', '', ['placeholder' => Lang::get('admin-forms.game-age-ph')]) }}

            {{ Form::label('age_en', ucfirst(Lang::get('admin-forms.game-age-en'))) }}
            {{ Form::text('age_en', '', ['placeholder' => Lang::get('admin-forms.game-age-ph')]) }}

            {{ Form::label('price', ucfirst(Lang::get('admin-forms.game-price'))) }}
            {{ Form::text('price', '', ['placeholder' => Lang::get('admin-forms.game-price')]) }}

            {{ Form::label('producer', ucfirst(Lang::get('admin-forms.game-producer'))) }}
            <i class="fa fa-asterisk"></i>
            {{ Form::text('producer', '', ['placeholder' => Lang::get('admin-forms.game-producer')]) }}

            {{ Form::label('availability', ucfirst(Lang::get('admin-forms.game-availability'))) }}
            {{ Form::text('availability', '', ['placeholder' => Lang::get('admin-forms.game-availability')]) }}

            {{ Form::label('budgetgroup', ucfirst(Lang::get('admin-forms.game-budgetgroup'))) }}
            <i class="fa fa-asterisk"></i>
            {{ Form::select('budgetgroup', $budgetgroups) }}

            {{ Form::label('theme', ucfirst(Lang::get('admin-forms.game-theme'))) }}
            <i class="fa fa-asterisk"></i>
            {{ Form::select('theme', $themes) }}

            {{ Form::label('rules_nl', ucfirst(Lang::get('admin-forms.game-rules-nl'))) }}
            {{ Form::textarea('rules_nl', '', ['class' => 'ckeditor','placeholder' => Lang::get('admin-forms.game-rules-ph')]) }}

            {{ Form::label('rules_en', ucfirst(Lang::get('admin-forms.game-rules-en'))) }}
            {{ Form::textarea('rules_en', '', ['class' => 'ckeditor','placeholder' => Lang::get('admin-forms.game-rules-ph')]) }}

            {{ Form::label('duration_nl', ucfirst(Lang::get('admin-forms.game-duration-nl'))) }}
            {{ Form::text('duration_nl', '', ['placeholder' => Lang::get('admin-forms.game-duration-ph')]) }}

            {{ Form::label('duration_en', ucfirst(Lang::get('admin-forms.game-duration-en'))) }}
            {{ Form::text('duration_en', '', ['placeholder' => Lang::get('admin-forms.game-duration-ph')]) }}

            {{ Form::label('players', ucfirst(Lang::get('admin-forms.game-players'))) }}
            <i class="fa fa-asterisk"></i>
            {{ Form::text('players', '', ['placeholder' => Lang::get('admin-forms.game-players-ph')]) }}

            {{ Form::label('functions', ucfirst(Lang::get('admin-forms.game-functions'))) }}
            <i class="fa fa-asterisk"></i>
            {{ Form::select('functions[]', $functions, null, ['multiple' => true, 'id' => 'mselect', 'placeholder' => Lang::get('admin-forms.game-functions-ph')]) }}

            {{ Form::label('therapeutic_nl', ucfirst(Lang::get('admin-forms.game-therapeutic-nl'))) }}
            {{ Form::textarea('therapeutic_nl', '', ['class' => 'ckeditor','placeholder' => Lang::get('admin-forms.game-therapeutic-ph')]) }}

            {{ Form::label('therapeutic_en', ucfirst(Lang::get('admin-forms.game-therapeutic-en'))) }}
            {{ Form::textarea('therapeutic_en', '', ['class' => 'ckeditor','placeholder' => Lang::get('admin-forms.game-therapeutic-ph')]) }}

            {{ Form::label('image', ucfirst(Lang::get('admin-forms.game-image'))) }}
            <!--<div class="fileUpload button">
                <span>Upload</span>-->
            {{ Form::file('image', ['class' => 'upload']) }}
            <!--</div>-->

            {{ Form::label('features_nl', ucfirst(Lang::get('admin-forms.game-features-nl'))) }}
            {{ Form::textarea('features_nl', '', ['class' => 'ckeditor','placeholder' => Lang::get('admin-forms.game-features-ph')]) }}

            {{ Form::label('features_en', ucfirst(Lang::get('admin-forms.game-features-en'))) }}
            {{ Form::textarea('features_en', '', ['class' => 'ckeditor','placeholder' => Lang::get('admin-forms.game-features-ph')]) }}

            {{ Form::label('tags_nl', ucfirst(Lang::get('admin-forms.game-tags-nl'))) }}
            {{ Form::text('tags_nl', '', ['placeholder' => Lang::get('admin-forms.game-tags-ph')]) }}

            {{ Form::label('tags_en', ucfirst(Lang::get('admin-forms.game-tags-en'))) }}
            {{ Form::text('tags_en', '', ['placeholder' => Lang::get('admin-forms.game-tags-ph')]) }}

            {{ Form::submit(Lang::get('admin-forms.submit-add'), ['class' => 'button button-submit']), PHP_EOL }}
            {{ HTML::link('/admin/games', Lang::get('admin-forms.game-list'), ['' => '']), PHP_EOL }}
            {{ Form::close(), PHP_EOL }}

        </div>
    </div>
</div>


@stop

@section('userScripts')

{{ HTML::script("../vendor/ckeditor/ckeditor.js") }}

<script>
    // TODO : aparte file

    $(document).ready(function() {
        $("#mselect").select2();
    });
</script>

@stop