@extends('layouts.web.master')

@section('content')
<div class="row breadcrumb">
    <div class="small-12 columns paddingfix">
        <ul class="breadcrumbs">
            <li><a href="{{ URL::to('/')}}">Home</a></li>
            <li class="unactive">{{ Lang::get('web-profiel.breadcrumb')}}</li>
        </ul>
    </div>
</div>
<div id="profiel">
    <div class="row">
        <div class="small-12 columns">
            <h2>{{ Lang::get('web-profiel.form-header')}}</h2>
            {{ Form::open(['route' => 'web.edit']), PHP_EOL }}

                {{ Form::label('givenname', Lang::get('web-profiel.form-firstname'),['class' => ($errors->has('givenname') ? 'error' : '' )])}}
                {{ Form::text('givenname', $user->person->person_givenname,['class' => ($errors->has('givenname') ? 'error' : '' )]) }}
                @if ($errors->has('givenname'))
                {{ $errors->first('givenname', '<small class="error">:message</small>') }}
                @endif

                {{ Form::label('surname', Lang::get('web-profiel.form-lastname'),['class' => ($errors->has('surname') ? 'error' : '' ),])}}
                {{ Form::text('surname', $user->person->person_surname,['class' => ($errors->has('givenname') ? 'error' : '' )]) }}
                @if ($errors->has('surname'))
                {{ $errors->first('surname', '<small class="error">:message</small>') }}
                @endif

                {{ Form::label('email', Lang::get('web-profiel.form-email'),['class' => ($errors->has('email') ? 'error' : '' ),])}}
                {{ Form::email('email', $user->person->person_email,['class' => ($errors->has('email') ? 'error' : '' )]) }}
                @if ($errors->has('email'))
                {{ $errors->first('email', '<small class="error">:message</small>') }}
                @endif

                {{ Form::submit(Lang::get('web-profiel.form-button'), ['class' => 'button tiny']), PHP_EOL }}

            {{ Form::close(), PHP_EOL }}
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="small-12 medium-6 columns">
            <div class="panel_blue">
                <div class="panel_title">
                    <h3>{{ Lang::get('web-profiel.fiches-header')}} <a href="{{ URL::to('web/user/profile/register/client') }}" class="right add-client"><i class="fa fa-plus"></i></a></h3>
                </div>
                <ul class="liststyle">
                    @foreach(Auth::user()->clients as $m)
                    <li><a href="{{ URL::to('web/user/profile/player/' . $m->client_id) }}">{{$m->person->person_givenname}} {{$m->person->person_surname}} &raquo;</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="small-12 medium-6 columns">
            <div class="panel_green">
                <div class="panel_title">
                    <h3>{{ Lang::get('web-profiel.wishlist-header')}} <i class="right fa fa-star"></i></h3>
                </div>
                <ul class="liststyle">
                    @if(App::getLocale() == 'nl')
                        @foreach($wishlist as $g)
                        <li><a href="{{ URL::to('web/game/' . $g->game_id) }}">{{$g->game_title_nl}} &raquo;</a></li>
                        @endforeach
                        @if(count($wishlist)== 0)
                        <li><p>Nog geen spellen.</p></li>
                        @endif
                    @else
                        @foreach($wishlist as $g)
                        <li><a href="{{ URL::to('web/game/' . $g->game_id) }}">{{$g->game_title_en}} &raquo;</a></li>
                        @endforeach
                        @if(count($wishlist)== 0)
                        <li><p>No games yet.</p></li>
                        @endif
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
@stop