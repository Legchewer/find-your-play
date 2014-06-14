@extends('layouts.admin.master')

@section('content')

<div class="content games">
    <div class="row">
        <div class="large-12 columns content-header">

            <h1><i class="fa fa-puzzle-piece"></i> {{ Lang::choice('admin-pages.games', 1) }} <small>Edit {{ strtolower(Lang::choice('admin-pages.games', 0)) }}</small></h1>

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

            {{ Form::open(['route' => ['admin.games.update', $game->game_id], 'files' => true]), PHP_EOL }}

            {{ Form::hidden('game_id', $game->game_id, ['id' => 'game_id']) }}

            {{ Form::label('title_nl', ucfirst(Lang::get('admin-forms.game-title-nl'))) }}
            <i class="fa fa-asterisk"> {{ Lang::get('admin-forms.one-language') }}</i>
            {{ Form::text('title_nl', $game->game_title_nl, ['placeholder' => Lang::get('admin-forms.game-title-ph')]) }}

            {{ Form::label('title_en', ucfirst(Lang::get('admin-forms.game-title-en'))) }}
            <i class="fa fa-asterisk"> {{ Lang::get('admin-forms.one-language') }}</i>
            {{ Form::text('title_en', $game->game_title_en, ['placeholder' => Lang::get('admin-forms.game-title-ph')]) }}

            {{ Form::label('type', ucfirst(Lang::get('admin-forms.game-type'))) }}
            {{ Form::select('type', $types, $game->gameType->game_type_id) }}

            {{ Form::label('description_nl', ucfirst(Lang::get('admin-forms.game-description-nl'))) }}
            {{ Form::textarea('description_nl', $game->game_description_nl, ['class' => 'ckeditor','placeholder' => Lang::get('admin-forms.game-description-ph')]) }}

            {{ Form::label('description_en', ucfirst(Lang::get('admin-forms.game-description-en'))) }}
            {{ Form::textarea('description_en', $game->game_description_en, ['class' => 'ckeditor','placeholder' => Lang::get('admin-forms.game-description-ph')]) }}

            {{ Form::label('difficulty', ucfirst(Lang::get('admin-forms.game-difficulty'))) }}
            <i class="fa fa-asterisk"></i>
            {{ Form::select('difficulty', $difficulties, $game->gameDifficulty->game_difficulty_id) }}

            {{ Form::label('age_nl', ucfirst(Lang::get('admin-forms.game-age-nl'))) }}
            <i class="fa fa-asterisk"> {{ Lang::get('admin-forms.one-language') }}</i>
            {{ Form::text('age_nl', $game->game_age_nl, ['placeholder' => Lang::get('admin-forms.game-age-ph')]) }}

            {{ Form::label('age_en', ucfirst(Lang::get('admin-forms.game-age-en'))) }}
            <i class="fa fa-asterisk"> {{ Lang::get('admin-forms.one-language') }}</i>
            {{ Form::text('age_en', $game->game_age_en, ['placeholder' => Lang::get('admin-forms.game-age-ph')]) }}

            {{ Form::label('players', ucfirst(Lang::get('admin-forms.game-players'))) }}
            <i class="fa fa-asterisk"></i>
            {{ Form::select('players', $players, $game->gamePlayers->game_players_id) }}

            {{ Form::label('price', ucfirst(Lang::get('admin-forms.game-price'))) }}
            {{ Form::text('price', $game->game_price, ['placeholder' => Lang::get('admin-forms.game-price')]) }}

            {{ Form::label('producer', ucfirst(Lang::get('admin-forms.game-producer'))) }}
            <i class="fa fa-asterisk"></i>
            {{ Form::text('producer', $game->game_producer, ['placeholder' => Lang::get('admin-forms.game-producer')]) }}

            {{ Form::label('availability', ucfirst(Lang::get('admin-forms.game-availability'))) }}
            {{ Form::text('availability', $game->game_availability, ['placeholder' => Lang::get('admin-forms.game-availability')]) }}

            {{ Form::label('budgetgroup', ucfirst(Lang::get('admin-forms.game-budgetgroup'))) }}
            <i class="fa fa-asterisk"></i>
            {{ Form::select('budgetgroup', $budgetgroups, $game->budgetGroup->budget_group_id) }}

            {{ Form::label('theme', ucfirst(Lang::get('admin-forms.game-theme'))) }}
            <i class="fa fa-asterisk"></i>
            {{ Form::select('theme', $themes, $game->theme->theme_id) }}

            {{ Form::label('rules_nl', ucfirst(Lang::get('admin-forms.game-rules-nl'))) }}
            {{ Form::textarea('rules_nl', $game->game_rules_nl, ['class' => 'ckeditor','placeholder' => Lang::get('admin-forms.game-rules-ph')]) }}

            {{ Form::label('rules_en', ucfirst(Lang::get('admin-forms.game-rules-en'))) }}
            {{ Form::textarea('rules_en', $game->game_rules_en, ['class' => 'ckeditor','placeholder' => Lang::get('admin-forms.game-rules-ph')]) }}

            {{ Form::label('duration_nl', ucfirst(Lang::get('admin-forms.game-duration-nl'))) }}
            {{ Form::text('duration_nl', $game->game_duration_nl, ['placeholder' => Lang::get('admin-forms.game-duration-ph')]) }}

            {{ Form::label('duration_en', ucfirst(Lang::get('admin-forms.game-duration-en'))) }}
            {{ Form::text('duration_en', $game->game_duration_en, ['placeholder' => Lang::get('admin-forms.game-duration-ph')]) }}

            {{ Form::label('functions', ucfirst(Lang::get('admin-forms.game-functions'))) }}
            <i class="fa fa-asterisk"></i>
            {{ Form::select('functions[]', $functions, null, ['multiple' => true, 'id' => 'mselect', 'placeholder' => Lang::get('admin-forms.game-functions-ph')]) }}

            {{ Form::label('therapeutic_nl', ucfirst(Lang::get('admin-forms.game-therapeutic-nl'))) }}
            {{ Form::textarea('therapeutic_nl', $game->game_therapeutic_nl, ['class' => 'ckeditor','placeholder' => Lang::get('admin-forms.game-therapeutic-ph')]) }}

            {{ Form::label('therapeutic_en', ucfirst(Lang::get('admin-forms.game-therapeutic-en'))) }}
            {{ Form::textarea('therapeutic_en', $game->game_therapeutic_en, ['class' => 'ckeditor','placeholder' => Lang::get('admin-forms.game-therapeutic-ph')]) }}

            @if ($game->game_image == '')

            {{ Form::label('', ucfirst(Lang::get('admin-forms.game-no-image'))) }}

            @else

            {{ Form::label('', ucfirst(Lang::get('admin-forms.game-current-image'))) }}
            <div class="current-image">
                {{ HTML::image('uploads/images/' . $game->game_image) }}
            </div>

            @endif

            {{ Form::label('image', ucfirst(Lang::get('admin-forms.game-image'))) }}
            {{ Form::file('image', ['class' => 'upload']) }}

            {{ Form::label('features_nl', ucfirst(Lang::get('admin-forms.game-features-nl'))) }}
            <textarea name="features_nl" id="features_nl" placeholder="{{ Lang::get('admin-forms.game-features-ph') }}">@foreach ($game_features_nl as $feature){{ $feature->game_feature_name . ', ' . $feature->game_feature_value . PHP_EOL }}@endforeach</textarea>

            {{ Form::label('features_en', ucfirst(Lang::get('admin-forms.game-features-en'))) }}
            <textarea name="features_en" id="features_en" placeholder="{{ Lang::get('admin-forms.game-features-ph') }}">@foreach ($game_features_en as $feature){{ $feature->game_feature_name . ', ' . $feature->game_feature_value . PHP_EOL }}@endforeach</textarea>

            {{ Form::label('tags_nl', ucfirst(Lang::get('admin-forms.game-tags-nl'))) }}
            {{ Form::text('tags_nl', implode(',', $game_tags_nl), ['placeholder' => Lang::get('admin-forms.game-tags-ph')]) }}

            {{ Form::label('tags_en', ucfirst(Lang::get('admin-forms.game-tags-en'))) }}
            {{ Form::text('tags_en', implode(',', $game_tags_en), ['placeholder' => Lang::get('admin-forms.game-tags-ph')]) }}

            {{ Form::submit(Lang::get('admin-forms.submit-update'), ['class' => 'button button-submit']), PHP_EOL }}
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

        // get current selected values as json

        // get current game id from hidden form field

        var id = $('#game_id').val();

        // get functions

        getForGame(id, "functions").success(function(data){
            var function_ids = [];

            $.each(data, function(i, value){
                function_ids.push(value.game_function_id);
            });

            $("#mselect").val(function_ids).select2();
        });

    });

    function getForGame(id, type)
    {
        // change RESTful path according to location

        var pathArray = window.location.pathname.split( '/' );

        // create root public path
        var newPathname = "";

        for (i = 0; i < pathArray.length - 4; i++) {
            if(i !== 0){
                newPathname += "/";
            }
            newPathname += pathArray[i];
        }

        // add the rest of the path
        newPathname += "/api/game/";

        var RESTURL = window.location.protocol + '//' + window.location.host + newPathname;

        return $.ajax({
            type:"GET",
            dataType:"json",
            contentType:"application/json",
            cache:false,
            url:RESTURL + id + "/" + type
        });
    }
</script>

@stop