@extends('layouts.web.master')

@section('content')
<div class="row">
    <div class="small-12 columns">
        <ul class="breadcrumbs">
            <li><a href="{{ url('/')}}">Home</a></li>
            <li><a href="{{ url('/web/search')}}">{{ Lang::get('web-zoeken.breadcrumb')}}</a></li>
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
        @if($game)
            <dd class="active"><a href="#panel1a">{{ Lang::get('web-speldetail.game-info') }}</a></dd>
            @if($features)
            <dd><a href="#panel2a">{{ Lang::get('web-speldetail.game-characteristic') }}</a></dd>
            @endif
            @if($game->gameFunctions)
            <dd><a href="#panel3a">{{ Lang::get('web-speldetail.game-function') }}</a></dd>
            @endif
            <dd><a href="#panel4a">{{ Lang::get('web-speldetail.game-buy') }}</a></dd>
        @endif
        </dl>
        <div class="tabs-content vertical">
            <div class="wishlist"><a href="#" title="Add to wishlist"><i class="right fa fa-star-o fa-2x"></i></a></div>
        @if($game)
            <div class="content active" id="panel1a">
            @if($game->gameType->gameKind->game_kind_name_nl)
                <label>{{ Lang::get('web-speldetail.game-kind') }}</label> <p>{{$game->gameType->gameKind->game_kind_name_nl}}</p>
            @endif
            @if($game->gameType->game_type_name_nl)
                <label>{{ Lang::get('web-speldetail.game-type') }}</label> <p>{{$game->gameType->game_type_name_nl}}</p>
            @endif
            @if($game->gamePlayers->game_players_name_nl)
                <label>{{ Lang::get('web-speldetail.game-players') }}</label> <p>{{$game->gamePlayers->game_players_name_nl}}</p>
            @endif
            @if($game->game_duration_nl)
                <label>{{ Lang::get('web-speldetail.game-hour') }}</label> <p>{{$game->game_duration_nl}}</p>
            @endif
            @if($game->game_age_nl)
                <label>{{ Lang::get('web-speldetail.game-age') }}</label> <p>{{$game->game_age_nl}}</p>
            @endif
            @if($game->theme)
                <label>{{ Lang::get('web-speldetail.game-theme') }}</label> <p>{{ $game->theme->theme_name_nl }}</p>
            @endif
            @if($game->image)
                <label>{{ Lang::get('web-speldetail.game-image') }}</label> <p>Neen</p>
            @endif
            </div>
            @if($features)
            <div class="content" id="panel2a">
                @if(array_key_exists('spel idee',$features))
                    <label>{{ Lang::get('web-speldetail.game-idea') }}</label> <p>{{ $features['spel idee']}}</p>
                @endif
                @if(array_key_exists('afmeting puzzel',$features))
                    <label>{{ Lang::get('web-speldetail.game-dimension') }}</label> <p>{{ $features['afmeting puzzel']}}</p>
                @endif
                @if(array_key_exists('gemiddelde grootte stukken',$features))
                    <label>{{ Lang::get('web-speldetail.game-sizepieces') }}</label> <p>{{ $features['gemiddelde grootte stukken']}}</p>
                @endif
                @if(array_key_exists('aantal stukken',$features))
                    <label>{{ Lang::get('web-speldetail.game-countpieces') }}</label> <p>{{ $features['aantal stukken']}}</p>
                @endif
                @if(array_key_exists('vorm stukken',$features))
                    <label>{{ Lang::get('web-speldetail.game-shapepieces') }}</label> <p>{{ $features['vorm stukken']}}</p>
                @endif
                @if(array_key_exists('materiaal',$features))
                    <label>{{ Lang::get('web-speldetail.game-material') }}</label> <p>{{ $features['materiaal']}}</p>
                @endif
                @if(array_key_exists('systeem verbinding',$features))
                    <label>{{ Lang::get('web-speldetail.game-system') }}</label> <p>{{ $features['systeem verbinding']}}</p>
                @endif
                @if(array_key_exists('kan in doos worden gemaakt',$features))
                    <label>{{ Lang::get('web-speldetail.game-box') }}</label> <p>{{ $features['kan in doos worden gemaakt']}}</p>
                @endif
                @if(array_key_exists('abstract/concreet',$features))
                    <label>{{ Lang::get('web-speldetail.game-abstract') }}</label> <p>{{ $features['abstract/concreet']}}</p>
                @endif
                @if(array_key_exists('detail',$features))
                    <label>{{ Lang::get('web-speldetail.game-detail') }}</label> <p>{{ $features['detail']}}</p>
                @endif
                @if(array_key_exists('figuur achtergrond',$features))
                    <label>{{ Lang::get('web-speldetail.game-background') }}</label> <p>{{ $features['figuur achtergrond']}}</p>
                @endif
                @if(array_key_exists('niveau',$features))
                    <label>{{ Lang::get('web-speldetail.game-level') }}</label> <p>{{ $features['niveau']}}</p>
                @endif
                @if(array_key_exists('sfeer',$features))
                    <label>{{ Lang::get('web-speldetail.game-atmosphere') }}</label> <p>{{ $features['sfeer']}}</p>
                @endif
                @if(array_key_exists('geluksfactor',$features))
                    <label>{{ Lang::get('web-speldetail.game-happiness') }}</label> <p>{{ $features['geluksfactor']}}</p>
                @endif
                @if(array_key_exists('kleurcontrast',$features))
                    <label>{{ Lang::get('web-speldetail.game-colorcontrast') }}</label> <p>{{ $features['kleurcontrast']}}</p>
                @endif
                @if(array_key_exists('variatie',$features))
                    <label>{{ Lang::get('web-speldetail.game-variation') }}</label> <p>{{ $features['variatie']}}</p>
                @endif
            </div>
            @endif
            @if($game->gameFunctions)
            <div class="content" id="panel3a">
                    <label>{{ Lang::get('web-speldetail.game-cognitive') }}</label> <p>{{$cognitive}}</p>
                    <label>{{ Lang::get('web-speldetail.game-fysical') }}</label> <p>{{$fysical}}</p>
                    <label>{{ Lang::get('web-speldetail.game-social') }}</label> <p>{{$social}}</p>
                    <label>{{ Lang::get('web-speldetail.game-emotions') }}</label> <p>{{$emotional}}</p>
            </div>
            @endif
            <div class="content" id="panel4a">
                <label>{{ Lang::get('web-speldetail.game-price') }}</label> <p>{{$game->game_price}}</p>
                <label>{{ Lang::get('web-speldetail.game-producer') }}</label> <p>{{$game->game_producer}}</p>
                <label>{{ Lang::get('web-speldetail.game-availability') }}</label> <a href="http://{{$game->game_availability}}" title="{{$game->game_availability}}" target="_blank">{{$game->game_availability}}</a>
            </div>
        </div>
        @endif
    </div>
</div>
@else
<div class="row">
    <div class="small-12 columns detailspel">
        <dl class="tabs vertical" data-tab>
            @if($game)
            <dd class="active"><a href="#panel1a">{{ Lang::get('web-speldetail.game-info') }}</a></dd>
            @if($features)
            <dd><a href="#panel2a">{{ Lang::get('web-speldetail.game-characteristic') }}</a></dd>
            @endif
            @if($game->gameFunctions)
            <dd><a href="#panel3a">{{ Lang::get('web-speldetail.game-function') }}</a></dd>
            @endif
            <dd><a href="#panel4a">{{ Lang::get('web-speldetail.game-buy') }}</a></dd>
            @endif
        </dl>
        <div class="tabs-content vertical">
            <div class="wishlist"><a href="#" title="Add to wishlist"><i class="right fa fa-star-o fa-2x"></i></a></div>
            @if($game)
            <div class="content active" id="panel1a">
                @if($game->gameType->gameKind->game_kind_name_en)
                <label>{{ Lang::get('web-speldetail.game-kind') }}</label> <p>{{$game->gameType->gameKind->game_kind_name_en}}</p>
                @endif
                @if($game->gameType->game_type_name_en)
                <label>{{ Lang::get('web-speldetail.game-type') }}</label> <p>{{$game->gameType->game_type_name_en}}</p>
                @endif
                @if($game->gamePlayers->game_players_name_en)
                <label>{{ Lang::get('web-speldetail.game-players') }}</label> <p>{{$game->gamePlayers->game_players_name_en}}</p>
                @endif
                @if($game->game_duration_en)
                <label>{{ Lang::get('web-speldetail.game-hour') }}</label> <p>{{$game->game_duration_en}}</p>
                @endif
                @if($game->game_age_en)
                <label>{{ Lang::get('web-speldetail.game-age') }}</label> <p>{{$game->game_age_en}}</p>
                @endif
                @if($game->theme)
                <label>{{ Lang::get('web-speldetail.game-theme') }}</label> <p>{{ $game->theme->theme_name_en }}</p>
                @endif
                @if($game->image)
                <label>{{ Lang::get('web-speldetail.game-image') }}</label> <p>Neen</p>
                @endif
            </div>
            @if($features)
            <div class="content" id="panel2a">
                @if(array_key_exists('game idea',$features))
                <label>{{ Lang::get('web-speldetail.game-idea') }}</label> <p>{{ $features['game idea']}}</p>
                @endif
                @if(array_key_exists('measurements puzzle',$features))
                <label>{{ Lang::get('web-speldetail.game-dimension') }}</label> <p>{{ $features['measurements puzzle']}}</p>
                @endif
                @if(array_key_exists('average size pieces',$features))
                <label>{{ Lang::get('web-speldetail.game-sizepieces') }}</label> <p>{{ $features['average size pieces']}}</p>
                @endif
                @if(array_key_exists('number of pieces',$features))
                <label>{{ Lang::get('web-speldetail.game-countpieces') }}</label> <p>{{ $features['number of pieces']}}</p>
                @endif
                @if(array_key_exists('shape pieces',$features))
                <label>{{ Lang::get('web-speldetail.game-shapepieces') }}</label> <p>{{ $features['shape pieces']}}</p>
                @endif
                @if(array_key_exists('material',$features))
                <label>{{ Lang::get('web-speldetail.game-material') }}</label> <p>{{ $features['material']}}</p>
                @endif
                @if(array_key_exists('system connection',$features))
                <label>{{ Lang::get('web-speldetail.game-system') }}</label> <p>{{ $features['system connection']}}</p>
                @endif
                @if(array_key_exists('kan in doos worden gemaakt',$features))
                <label>{{ Lang::get('web-speldetail.game-box') }}</label> <p>{{ $features['kan in doos worden gemaakt']}}</p>
                @endif
                @if(array_key_exists('abstract/concrete',$features))
                <label>{{ Lang::get('web-speldetail.game-abstract') }}</label> <p>{{ $features['abstract/concrete']}}</p>
                @endif
                @if(array_key_exists('detail',$features))
                <label>{{ Lang::get('web-speldetail.game-detail') }}</label> <p>{{ $features['detail']}}</p>
                @endif
                @if(array_key_exists('figure background',$features))
                <label>{{ Lang::get('web-speldetail.game-background') }}</label> <p>{{ $features['figure background']}}</p>
                @endif
                @if(array_key_exists('level',$features))
                <label>{{ Lang::get('web-speldetail.game-level') }}</label> <p>{{ $features['level']}}</p>
                @endif
                @if(array_key_exists('feel',$features))
                <label>{{ Lang::get('web-speldetail.game-atmosphere') }}</label> <p>{{ $features['feel']}}</p>
                @endif
                @if(array_key_exists('luck factor',$features))
                <label>{{ Lang::get('web-speldetail.game-happiness') }}</label> <p>{{ $features['luck factor']}}</p>
                @endif
                @if(array_key_exists('color contrast',$features))
                <label>{{ Lang::get('web-speldetail.game-colorcontrast') }}</label> <p>{{ $features['color contrast']}}</p>
                @endif
                @if(array_key_exists('variation',$features))
                <label>{{ Lang::get('web-speldetail.game-variation') }}</label> <p>{{ $features['variation']}}</p>
                @endif
            </div>
            @endif
            @if($game->gameFunctions)
            <div class="content" id="panel3a">
                <label>{{ Lang::get('web-speldetail.game-cognitive') }}</label> <p>{{$cognitive}}</p>
                <label>{{ Lang::get('web-speldetail.game-fysical') }}</label> <p>{{$fysical}}</p>
                <label>{{ Lang::get('web-speldetail.game-social') }}</label> <p>{{$social}}</p>
                <label>{{ Lang::get('web-speldetail.game-emotions') }}</label> <p>{{$emotional}}</p>
            </div>
            @endif
            <div class="content" id="panel4a">
                <label>{{ Lang::get('web-speldetail.game-price') }}</label> <p>{{$game->game_price}}</p>
                <label>{{ Lang::get('web-speldetail.game-producer') }}</label> <p>{{$game->game_producer}}</p>
                <label>{{ Lang::get('web-speldetail.game-availability') }}</label> <a href="http://{{$game->game_availability}}" title="{{$game->game_availability}}" target="_blank">{{$game->game_availability}}</a>
            </div>
        </div>
        @endif
    </div>
</div>
@endif

@stop