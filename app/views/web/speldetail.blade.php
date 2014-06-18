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
    <div class="detailspel">
        <dl class="tabs vertical small-12 medium-4 large-4 columns" data-tab>
        @if($game)
            <dd class="active"><a href="#panel1a">{{ Lang::get('web-speldetail.game-info') }}</a></dd>
            @if($features)
            <dd><a href="#panel2a">{{ Lang::get('web-speldetail.game-characteristic') }}</a></dd>
            @endif
            @if($game->gameFunctions)
            <dd><a href="#panel3a">{{ Lang::get('web-speldetail.game-function') }}</a></dd>
            @endif
            <dd><a href="#panel4a">{{ Lang::get('web-speldetail.game-buy') }}</a></dd>
            <dd><a href="#panel5a">Feedback</a></dd>
            <dd><a href="#panel6a">{{ Lang::get('web-speldetail.fiche') }}</a></dd>
        @endif
        </dl>
        <div class="tabs-content vertical small-12 medium-4 large-4 columns">
            @if(Auth::user())
            @if(!in_array($game->game_id,$wishlist))
            <div class="wishlist">
                {{ Form::open(['route' => ['web.game.post',$game->game_id ]]), PHP_EOL }}
                {{ Form::submit(Lang::get('web-speldetail.button'), ['class' => 'button tiny right']), PHP_EOL }}
                {{ Form::close(), PHP_EOL }}
            </div>
            @else
            {{ Form::open(['route' => ['web.game.post.remove',$game->game_id ]]), PHP_EOL }}
            {{ Form::submit(Lang::get('web-speldetail.button2'), ['class' => 'button alert tiny right']), PHP_EOL }}
            {{ Form::close(), PHP_EOL }}
            @endif
            @endif
        @if($game)
            <div class="content active infopanels" id="panel1a">
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
            <div class="content infopanels" id="panel2a">
                @foreach($features as $f)
                <label>{{$f->game_feature_name}}</label>
                <p>{{$f->game_feature_value}}</p>
                @endforeach
            </div>
            @endif
            @if($game->gameFunctions)
            <div class="content infopanels" id="panel3a">
                    <label>{{ Lang::get('web-speldetail.game-cognitive') }}</label> <p>{{$cognitive}}</p>
                    <label>{{ Lang::get('web-speldetail.game-fysical') }}</label> <p>{{$fysical}}</p>
                    <label>{{ Lang::get('web-speldetail.game-social') }}</label> <p>{{$social}}</p>
                    <label>{{ Lang::get('web-speldetail.game-emotions') }}</label> <p>{{$emotional}}</p>
            </div>
            @endif
            <div class="content infopanels" id="panel4a">
                <label>{{ Lang::get('web-speldetail.game-price') }}</label> <p>{{$game->game_price}}</p>
                <label>{{ Lang::get('web-speldetail.game-producer') }}</label> <p>{{$game->game_producer}}</p>
                <label>{{ Lang::get('web-speldetail.game-availability') }}</label> <a href="http://{{$game->game_availability}}" title="{{$game->game_availability}}" target="_blank">{{$game->game_availability}}</a>
            </div>
            <div class="content infopanels" id="panel5a">
                @if(!$game->feedback->isEmpty())
                    @foreach($game->feedback as $f)
                    <div class="feedback clearfix">
                        <p>{{$f->feedback_text}}</p>
                        <small>{{$f->member->person->person_givenname}} {{$f->member->person->person_surname}}</small>
                    </div>
                    @endforeach
                @else
                <div class="feedback">
                    <p>Nog geen feedback..</p>
                </div>
                @endif
                {{ Form::open(['route' => ['web.game.post.feedback',$game->game_id ]]), PHP_EOL }}

                {{ Form::label('feedback', 'Feedback',['class' => ($errors->has('feedback') ? 'error' : '' ),])}}
                {{ Form::textarea('feedback', '',['class' => ($errors->has('feedback') ? 'error' : '' )]) }}
                @if ($errors->has('feedback'))
                {{ $errors->first('feedback', '<small class="error">:message</small>') }}
                @endif

                {{ Form::submit(Lang::get('web-speldetail.button3'), ['class' => 'button tiny']), PHP_EOL }}

                {{ Form::close(), PHP_EOL }}
            </div>
            <div class="content" id="panel6a">
                {{ $game->game_therapeutic_nl }}
            </div>
        </div>
        @endif
    </div>
</div>
@else
<div class="row">
    <div class="detailspel">
        <dl class="tabs vertical small-12 medium-4 large-4 columns" data-tab>
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
            <dd><a href="#panel5a">Feedback</a></dd>
            <dd><a href="#panel6a">{{ Lang::get('web-speldetail.fiche') }}</a></dd>
        </dl>
        <div class="tabs-content vertical small-12 medium-8 large-8 columns">
            @if(Auth::User())
            @if(!in_array($game->game_id,$wishlist))
            <div class="wishlist">
                {{ Form::open(['route' => ['web.game.post',$game->game_id ]]), PHP_EOL }}
                {{ Form::submit(Lang::get('web-speldetail.button'), ['class' => 'button tiny right']), PHP_EOL }}
                {{ Form::close(), PHP_EOL }}
            </div>
            @else
            {{ Form::open(['route' => ['web.game.post.remove',$game->game_id ]]), PHP_EOL }}
            {{ Form::submit(Lang::get('web-speldetail.button2'), ['class' => 'button alert tiny right']), PHP_EOL }}
            {{ Form::close(), PHP_EOL }}
            @endif
            @endif
            @if($game)
            <div class="content active infopanels" id="panel1a">
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
            <div class="content infopanels" id="panel2a">
                @foreach($features as $f)
                <label>{{$f->game_feature_name}}</label>
                <p>{{$f->game_feature_value}}</p>
                @endforeach
            </div>
            @endif
            @if($game->gameFunctions)
            <div class="content infopanels" id="panel3a">
                <label>{{ Lang::get('web-speldetail.game-cognitive') }}</label> <p>{{$cognitive}}</p>
                <label>{{ Lang::get('web-speldetail.game-fysical') }}</label> <p>{{$fysical}}</p>
                <label>{{ Lang::get('web-speldetail.game-social') }}</label> <p>{{$social}}</p>
                <label>{{ Lang::get('web-speldetail.game-emotions') }}</label> <p>{{$emotional}}</p>
            </div>
            @endif
            <div class="content infopanels" id="panel4a">
                <label>{{ Lang::get('web-speldetail.game-price') }}</label> <p>{{$game->game_price}}</p>
                <label>{{ Lang::get('web-speldetail.game-producer') }}</label> <p>{{$game->game_producer}}</p>
                <label>{{ Lang::get('web-speldetail.game-availability') }}</label> <a href="http://{{$game->game_availability}}" title="{{$game->game_availability}}" target="_blank">{{$game->game_availability}}</a>
            </div>
            <div class="content infopanels" id="panel5a">
                @if(!$game->feedback->isEmpty())
                @foreach($game->feedback as $f)
                <div class="feedback clearfix">
                    <p>{{$f->feedback_text}}</p>
                    <small>{{$f->member->person->person_givenname}} {{$f->member->person->person_surname}}</small>
                </div>
                @endforeach
                @else
                <div class="feedback">
                    <p>No feedback yet..</p>
                </div>
                @endif
                {{ Form::open(['route' => ['web.game.post.feedback',$game->game_id ]]), PHP_EOL }}

                {{ Form::label('feedback', 'Feedback',['class' => ($errors->has('feedback') ? 'error' : '' ),])}}
                {{ Form::textarea('feedback', '',['class' => ($errors->has('feedback') ? 'error' : '' )]) }}
                @if ($errors->has('feedback'))
                {{ $errors->first('feedback', '<small class="error">:message</small>') }}
                @endif

                {{ Form::submit(Lang::get('web-speldetail.button3'), ['class' => 'button tiny']), PHP_EOL }}

                {{ Form::close(), PHP_EOL }}
            </div>
            <div class="content" id="panel6a">
                {{ $game->game_therapeutic_en }}
            </div>
        </div>
        @endif
    </div>
</div>
@endif

@stop