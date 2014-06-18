@extends('layouts.web.master')

@section('content')
<div class="row breadcrumb">
    <div class="small-12 columns paddingfix">
        <ul class="breadcrumbs">
            <li><a href="{{ URL::to('/')}}">Home</a></li>
            <li><a href="{{ URL::to('/web/user/profile')}}">{{ Lang::get('web-profiel.breadcrumb') }}</a></li>
            <li class="unactive">{{ Lang::get('web-profiel.breadcrumb-players') }}</li>
            <li class="current">{{ $client->person->person_givenname }}</li>
        </ul>
    </div>
</div>
<div class="experience">
    <div class="row">
        <div class="small-12 columns">
            <h2>{{ Lang::get('web-profiel.experience')}}</h2>
            <p>{{$client->client_experience}}</p>
        </div>
    </div>
</div>
@if(App::getLocale() == 'nl')
<div class="add-game right margintopfix">
    <button class="button secondary tiny">Spel toevoegen</button>
</div>
@else
<div class="add-game right margintopfix">
    <button class="button secondary tiny">Add a game</button>
</div>
@endif
<div id="add_game">
    <div class="row">
        <div class="small-12 columns">
            <h2>{{ Lang::get('web-add-game.title')}}</h2>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="small-12 columns">
            {{ Form::open(['route' => ['web.player.add.game',$client->client_id]]), PHP_EOL }}

            {{ Form::label('game',Lang::get('web-add-game.game'), ['class' => ($errors->has('game') ? 'error' : '' ),])}}
            {{ Form::select('game',  ['' => Lang::get('web-add-game.option')] + $game)}}
            @if ($errors->has('game'))
            {{ $errors->first('game', '<small class="error error-margin-fix">:message</small>') }}
            @endif

            {{ Form::label('usedate', Lang::get('web-add-game.usedate'),['class' => ($errors->has('usedate') ? 'error' : '' ),])}}
            {{ Form::text('usedate', '',['class' => ($errors->has('usedate') ? 'error' : 'datepicker' )]) }}
            @if ($errors->has('usedate'))
            {{ $errors->first('usedate', '<small class="error">:message</small>') }}
            @endif

            {{ Form::label('evaluation',Lang::get('web-add-game.evaluation'), ['class' => ($errors->has('evaluation') ? 'error' : '' ),])}}
            {{ Form::select('evaluation', ['' => Lang::get('web-add-game.option2'),'0' => '0','1' => '1','2' => '2','3' => '3','4' => '4','5' => '5'])}}
            @if ($errors->has('evaluation'))
            {{ $errors->first('evaluation', '<small class="error error-margin-fix">:message</small>') }}
            @endif

            {{ Form::label('duration', Lang::get('web-add-game.duration'),['class' => ($errors->has('duration') ? 'error' : '' ),])}}
            {{ Form::text('duration', '',['class' => ($errors->has('duration') ? 'error' : '' )]) }}
            @if ($errors->has('duration'))
            {{ $errors->first('duration', '<small class="error">:message</small>') }}
            @endif

            {{ Form::label('log', Lang::get('web-add-game.log'),['class' => ($errors->has('log') ? 'error' : '' ),])}}
            {{ Form::textarea('log', '',['class' => ($errors->has('log') ? 'error' : '' )]) }}
            @if ($errors->has('log'))
            {{ $errors->first('log', '<small class="error">:message</small>') }}
            @endif

            {{ Form::submit(Lang::get('web-add-game.button'), ['class' => 'button tiny']), PHP_EOL }}

            {{ Form::close(), PHP_EOL }}
        </div>
    </div>
</div>
<div id="players">
    <div class="row">
        <div class="small-12 columns">
            <h2>{{ Lang::get('web-profiel.title')}}</h2>
        </div>
    </div>
    <br/>
    <div class="row">
        @foreach ($client->games as $g)
        <div class="small-12 medium-6 columns">
            <div class="panel">
                <a href="{{ URL::to('web/game/' . $g->game_id)}}">{{ $g->game_title_nl}}</a>
                <a href="{{ URL::to('web/user/profile/player/' .$client->client_id . '/edit/' .$g->game_id) }}" class="right edit"><i class="fa fa-pencil"></i></a>
                <p>Datum: {{ $g->pivot->client_game_usedate}}</p>
                <p>Evaluatie: {{ $g->pivot->client_game_evaluation}}</p>
                <p>Duurtijd: {{ $g->pivot->client_game_duration}}</p>
                <p>Log: {{ $g->pivot->client_game_log}}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>
@stop
@section('userScripts')
    <script>
        $('.datepicker').fdatepicker({
            'format': "dd/mm/yyyy"
        });
    </script>
@stop