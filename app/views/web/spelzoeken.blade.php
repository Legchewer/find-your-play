@extends('layouts.web.master')

@section('content')
<div class="row">
    <div class="small-12 columns">
        <ul class="breadcrumbs">
            <li><a href="{{ url('/')}}">Home</a></li>
            <li class="current">{{ Lang::get('web-zoeken.breadcrumb')}}</li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="medium-3 columns">
        {{ Form::open(['route' => 'web.search.post']), PHP_EOL }}
            {{ Form::label('game_kind',Lang::get('web-zoeken.search-game'))}}
            {{ Form::select('game_kind', ['' => Lang::get('web-zoeken.search-option')] + $game_kinds)}}

            {{ Form::label('game_difficulty',Lang::get('web-zoeken.search-difficulty'))}}
            {{ Form::select('game_difficulty', ['' => Lang::get('web-zoeken.search-option')] + $game_difficulties)}}

            {{ Form::label('game_producer',Lang::get('web-zoeken.search-producer'))}}
            {{ Form::select('game_producer', ['' => Lang::get('web-zoeken.search-option')] + $game_producer)}}

            {{ Form::label('game_theme',Lang::get('web-zoeken.search-theme'))}}
            {{ Form::select('game_theme', ['' => Lang::get('web-zoeken.search-option')] + $game_themes)}}

            {{ Form::label('game_function',Lang::get('web-zoeken.search-functions'))}}
            {{ Form::select('game_function', ['' => Lang::get('web-zoeken.search-option')] + $game_functions)}}

            {{ Form::label('game_budget',Lang::get('web-zoeken.search-budget'))}}
            {{ Form::select('game_budget', ['' => Lang::get('web-zoeken.search-option')] + $game_budget)}}

            {{ Form::label('game_players',Lang::get('web-zoeken.search-players'))}}
            {{ Form::select('game_players', ['' => Lang::get('web-zoeken.search-option')] + $game_players)}}

            {{ Form::label('game_age',Lang::get('web-zoeken.search-age'))}}
            {{ Form::select('game_age', ['' => Lang::get('web-zoeken.search-option')] + $game_age)}}

        {{ Form::submit(Lang::get('web-zoeken.search-button'), ['class' => 'button tiny']), PHP_EOL }}
        {{ Form::close(), PHP_EOL }}
    </div>
    <div class="medium-9 columns">
        <ul class="small-block-grid-1 gameslist">
            @if(! $games->isEmpty() )
                @foreach($games as $g)
                    <li>
                        <a href="game/{{ $g->game_id }}">
                            <h1>{{$g->game_title}}</h1>
                            <p>{{$g->game_description}}</p>
                        </a>
                    </li>
                @endforeach
            @else
            <li><strong>{{Lang::get('web-zoeken.search-error')}}</strong></li>
            @endif
        </ul>
    </div>
</div>
@stop