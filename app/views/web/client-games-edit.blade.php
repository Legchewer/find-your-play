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
    <div class="row">
        <div class="small-12 columns">
            {{ Form::open(['route' => ['web.player.edit.post',$client->client_id, $game->game_id ]]), PHP_EOL }}

            {{ Form::label('usedate', Lang::get('web-add-game.usedate'),['class' => ($errors->has('usedate') ? 'error' : '' ),])}}
            {{ Form::text('usedate', $game->client_game_usedate,['class' => ($errors->has('usedate') ? 'error' : 'datepicker' )]) }}
            @if ($errors->has('usedate'))
            {{ $errors->first('usedate', '<small class="error">:message</small>') }}
            @endif

            {{ Form::label('evaluation',Lang::get('web-add-game.evaluation'), ['class' => ($errors->has('evaluation') ? 'error' : '' ),])}}
            {{ Form::select('evaluation', ['' => Lang::get('web-add-game.option2'),'0' => '0','1' => '1','2' => '2','3' => '3','4' => '4','5' => '5'],$game->client_game_evaluation)}}
            @if ($errors->has('evaluation'))
            {{ $errors->first('evaluation', '<small class="error error-margin-fix">:message</small>') }}
            @endif

            {{ Form::label('duration', Lang::get('web-add-game.duration'),['class' => ($errors->has('duration') ? 'error' : '' ),])}}
            {{ Form::text('duration', $game->client_game_duration,['class' => ($errors->has('duration') ? 'error' : '' )]) }}
            @if ($errors->has('duration'))
            {{ $errors->first('duration', '<small class="error">:message</small>') }}
            @endif

            {{ Form::label('log', Lang::get('web-add-game.log'),['class' => ($errors->has('log') ? 'error' : '' ),])}}
            {{ Form::textarea('log', $game->client_game_log,['class' => ($errors->has('log') ? 'error' : '' )]) }}
            @if ($errors->has('log'))
            {{ $errors->first('log', '<small class="error">:message</small>') }}
            @endif

            {{ Form::submit(Lang::get('web-add-game.button2'), ['class' => 'button tiny']), PHP_EOL }}

            {{ Form::close(), PHP_EOL }}
        </div>
    </div>
@stop
@section('userScripts')
    <script>
        var date = $('.datepicker').val();
        $('.datepicker').fdatepicker({
            'format': "dd/mm/yyyy",
            'setDate': date
        });
    </script>
@stop