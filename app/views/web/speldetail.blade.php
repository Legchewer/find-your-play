@extends('layouts.web.master')

@section('content')
<div class="row">
    <div class="small-12 columns">
        <ul class="breadcrumbs">
            <li><a href="{{ url('/')}}">Home</a></li>
            <li><a href="{{ url('/search')}}">{{ Lang::get('web-zoeken.breadcrumb')}}</a></li>
            @if (App::getLocale() == 'nl')
                <li class="current">{{$game->game_title_nl}}</li>
            @else
                <li class="current">{{$game->game_title_en}}</li>
            @endif
        </ul>
    </div>
</div>
@if(App::getLocale() == 'nl')
<div class="row">
    <div class="small-12 columns detailspel">
        <dl class="tabs vertical" data-tab>
            <dd class="active"><a href="#panel1a">{{ Lang::get('web-speldetail.game-info') }}</a></dd>
            <dd><a href="#panel2a">{{ Lang::get('web-speldetail.game-characteristic') }}</a></dd>
            <dd><a href="#panel3a">{{ Lang::get('web-speldetail.game-function') }}</a></dd>
            <dd><a href="#panel4a">{{ Lang::get('web-speldetail.game-buy') }}</a></dd>
        </dl>
        <div class="tabs-content vertical">
            <div class="content active" id="panel1a">
                <label>{{ Lang::get('web-speldetail.game-kind') }}</label> <p>{{$game->gameType->gameKind->game_kind_name_nl}}</p>
                <label>{{ Lang::get('web-speldetail.game-type') }}</label> <p>{{$game->gameType->game_type_name_nl}}</p>
                <label>{{ Lang::get('web-speldetail.game-players') }}</label> <p>{{--$game->gamePlayers->game_players_name_nl--}}</p>
                <label>{{ Lang::get('web-speldetail.game-hour') }}</label> <p>{{$game->game_duration_nl}}</p>
                <label>{{ Lang::get('web-speldetail.game-age') }}</label> <p>{{$game->game_age_nl}}</p>
            </div>
            <div class="content" id="panel2a">
                <label>{{ Lang::get('web-speldetail.game-idea') }}</label> <p>???</p>
                <label>{{ Lang::get('web-speldetail.game-theme') }}</label> <p>Nijntje - konijn - boerderij</p>
                <label>{{ Lang::get('web-speldetail.game-dimension') }}</label> <p>L - 50cm / B - 30cm / H - 0cm</p>
                <label>{{ Lang::get('web-speldetail.game-sizepieces') }}</label> <p>4cm</p>
                <label>{{ Lang::get('web-speldetail.game-countpieces') }}</label> <p>10</p>
                <label>{{ Lang::get('web-speldetail.game-shapepieces') }}</label> <p>???</p>
                <label>{{ Lang::get('web-speldetail.game-material') }}</label> <p>Kunststof</p>
                <label>{{ Lang::get('web-speldetail.game-system') }}</label> <p>Geen verbinding</p>
                <label>{{ Lang::get('web-speldetail.game-box') }}</label> <p>Niet van toepassing</p>
                <label>{{ Lang::get('web-speldetail.game-image') }}</label> <p>Neen</p>
                <label>{{ Lang::get('web-speldetail.game-abstract') }}</label> <p>Abstract</p>
                <label>{{ Lang::get('web-speldetail.game-detail') }}</label> <p>Weinig</p>
                <label>{{ Lang::get('web-speldetail.game-background') }}</label> <p>Duidelijk</p>
                <label>{{ Lang::get('web-speldetail.game-level') }}</label> <p>Gemakkelijk</p>
                <label>{{ Lang::get('web-speldetail.game-atmosphere') }}</label> <p>Ambiance</p>
                <label>{{ Lang::get('web-speldetail.game-happiness') }}</label> <p>Gemiddeld</p>
                <label>{{ Lang::get('web-speldetail.game-colorcontrast') }}</label> <p>???</p>
                <label>{{ Lang::get('web-speldetail.game-variation') }}</label> <p>???</p>
            </div>
            <div class="content" id="panel3a">
                <label>{{ Lang::get('web-speldetail.game-cognitive') }}</label> <p>{{--$game->gameFunctions->game_function_name_nl--}}</p>
                <label>{{ Lang::get('web-speldetail.game-fysical') }}</label> <p>{{--$game->gameFunctions->game_function_name_nl--}}</p>
                <label>{{ Lang::get('web-speldetail.game-social') }}</label> <p>{{--$game->gameFunctions->game_function_name_nl--}}</p>
                <label>{{ Lang::get('web-speldetail.game-emotions') }}</label> <p>{{--$game->gameFunctions->game_function_name_nl--}}</p>
            </div>
            <div class="content" id="panel4a">
                <label>{{ Lang::get('web-speldetail.game-price') }}</label> <p>{{$game->game_price}}</p>
                <label>{{ Lang::get('web-speldetail.game-producer') }}</label> <p>{{$game->game_producer}}</p>
                <label>{{ Lang::get('web-speldetail.game-availability') }}</label> <a href="https://{{$game->game_availability}}" title="{{$game->game_availability}}" target="_blank">{{$game->game_availability}}</a>
            </div>
        </div>
    </div>
</div>
@else
<div class="row">
    <div class="small-12 columns detailspel">
        <dl class="tabs vertical" data-tab>
            <dd class="active"><a href="#panel1a">{{ Lang::get('web-speldetail.game-info') }}</a></dd>
            <dd><a href="#panel2a">{{ Lang::get('web-speldetail.game-characteristic') }}</a></dd>
            <dd><a href="#panel3a">{{ Lang::get('web-speldetail.game-function') }}</a></dd>
            <dd><a href="#panel4a">{{ Lang::get('web-speldetail.game-buy') }}</a></dd>
        </dl>
        <div class="tabs-content vertical">
            <div class="content active" id="panel1a">
                <label>{{ Lang::get('web-speldetail.game-kind') }}</label> <p>{{$game->gameType->gameKind->game_kind_name_nl}}</p>
                <label>{{ Lang::get('web-speldetail.game-type') }}</label> <p>{{$game->gameType->game_type_name_nl}}</p>
                <label>{{ Lang::get('web-speldetail.game-players') }}</label> <p>{{--$game->gamePlayers->game_players_name_nl--}}</p>
                <label>{{ Lang::get('web-speldetail.game-hour') }}</label> <p>{{$game->game_duration_nl}}</p>
                <label>{{ Lang::get('web-speldetail.game-age') }}</label> <p>{{$game->game_age_nl}}</p>
            </div>
            <div class="content" id="panel2a">
                <label>{{ Lang::get('web-speldetail.game-idea') }}</label> <p>???</p>
                <label>{{ Lang::get('web-speldetail.game-theme') }}</label> <p>Nijntje - konijn - boerderij</p>
                <label>{{ Lang::get('web-speldetail.game-dimension') }}</label> <p>L - 50cm / B - 30cm / H - 0cm</p>
                <label>{{ Lang::get('web-speldetail.game-sizepieces') }}</label> <p>4cm</p>
                <label>{{ Lang::get('web-speldetail.game-countpieces') }}</label> <p>10</p>
                <label>{{ Lang::get('web-speldetail.game-shapepieces') }}</label> <p>???</p>
                <label>{{ Lang::get('web-speldetail.game-material') }}</label> <p>Kunststof</p>
                <label>{{ Lang::get('web-speldetail.game-system') }}</label> <p>Geen verbinding</p>
                <label>{{ Lang::get('web-speldetail.game-box') }}</label> <p>Niet van toepassing</p>
                <label>{{ Lang::get('web-speldetail.game-image') }}</label> <p>Neen</p>
                <label>{{ Lang::get('web-speldetail.game-abstract') }}</label> <p>Abstract</p>
                <label>{{ Lang::get('web-speldetail.game-detail') }}</label> <p>Weinig</p>
                <label>{{ Lang::get('web-speldetail.game-background') }}</label> <p>Duidelijk</p>
                <label>{{ Lang::get('web-speldetail.game-level') }}</label> <p>Gemakkelijk</p>
                <label>{{ Lang::get('web-speldetail.game-atmosphere') }}</label> <p>Ambiance</p>
                <label>{{ Lang::get('web-speldetail.game-happiness') }}</label> <p>Gemiddeld</p>
                <label>{{ Lang::get('web-speldetail.game-colorcontrast') }}</label> <p>???</p>
                <label>{{ Lang::get('web-speldetail.game-variation') }}</label> <p>???</p>
            </div>
            <div class="content" id="panel3a">
                <label>{{ Lang::get('web-speldetail.game-cognitive') }}</label> <p>{{--$game->gameFunctions->game_function_name_nl--}}</p>
                <label>{{ Lang::get('web-speldetail.game-fysical') }}</label> <p>{{--$game->gameFunctions->game_function_name_nl--}}</p>
                <label>{{ Lang::get('web-speldetail.game-social') }}</label> <p>{{--$game->gameFunctions->game_function_name_nl--}}</p>
                <label>{{ Lang::get('web-speldetail.game-emotions') }}</label> <p>{{--$game->gameFunctions->game_function_name_nl--}}</p>
            </div>
            <div class="content" id="panel4a">
                <label>{{ Lang::get('web-speldetail.game-price') }}</label> <p>{{$game->game_price}}</p>
                <label>{{ Lang::get('web-speldetail.game-producer') }}</label> <p>{{$game->game_producer}}</p>
                <label>{{ Lang::get('web-speldetail.game-availability') }}</label> <a href="https://{{$game->game_availability}}" title="{{$game->game_availability}}" target="_blank">{{$game->game_availability}}</a>
            </div>
        </div>
    </div>
</div>
@endif

@stop