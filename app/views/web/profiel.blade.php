@extends('layouts.web.master')

@section('content')
<div class="row breadcrumb">
    <div class="small-12 columns paddingfix">
        <ul class="breadcrumbs">
            <li><a href="{{ url('/')}}">Home</a></li>
            <li class="unactive">{{ Lang::get('web-profiel.breadcrumb')}}</li>
            <li class="current">{{$user->person_givenname}}</li>
        </ul>
    </div>
</div>
<div id="profiel">
    <div class="row">
        <div class="small-12 columns">
            <h2>{{ Lang::get('web-profiel.form-header')}}</h2>
            {{ Form::open(['route' => 'web.edit']), PHP_EOL }}

                {{ Form::label('givenname', Lang::get('web-profiel.form-firstname'),['class' => ($errors->has('givenname') ? 'error' : '' )])}}
                {{ Form::text('givenname', $user->person_givenname,['class' => ($errors->has('givenname') ? 'error' : '' )]) }}
                @if ($errors->has('givenname'))
                {{ $errors->first('givenname', '<small class="error">:message</small>') }}
                @endif

                {{ Form::label('surname', Lang::get('web-profiel.form-lastname'),['class' => ($errors->has('surname') ? 'error' : '' ),])}}
                {{ Form::text('surname', $user->person_surname,['class' => ($errors->has('givenname') ? 'error' : '' )]) }}
                @if ($errors->has('surname'))
                {{ $errors->first('surname', '<small class="error">:message</small>') }}
                @endif

                {{ Form::label('email', Lang::get('web-profiel.form-email'),['class' => ($errors->has('email') ? 'error' : '' ),])}}
                {{ Form::email('email', $user->person_email,['class' => ($errors->has('email') ? 'error' : '' )]) }}
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
                    <h3>{{ Lang::get('web-profiel.fiches-header')}} <i class="right fa fa-user"></i></h3>
                </div>
                <ul class="liststyle">
                    <li>
                        <a href="#" data-dropdown="drop">Voornaam Achternaam &raquo;</a>
                        <ul id="drop" class="tiny f-dropdown" data-dropdown-content>
                            <li><a href="#">Fiche</a></li>
                            <li><a href="#">Naam spel</a></li>
                            <li><a href="#">Naam spel 2</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" data-dropdown="drop1">Voornaam Achternaam &raquo;</a>
                        <ul id="drop1" class="tiny f-dropdown" data-dropdown-content>
                            <li><a href="#">Fiche</a></li>
                            <li><a href="#">Naam spel</a></li>
                            <li><a href="#">Naam spel 2</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" data-dropdown="drop2">Voornaam Achternaam &raquo;</a>
                        <ul id="drop2" class="tiny f-dropdown" data-dropdown-content>
                            <li><a href="#">Fiche</a></li>
                            <li><a href="#">Naam spel</a></li>
                            <li><a href="#">Naam spel 2</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="small-12 medium-6 columns">
            <div class="panel_green">
                <div class="panel_title">
                    <h3>{{ Lang::get('web-profiel.wishlist-header')}} <i class="right fa fa-star"></i></h3>
                </div>
                <ul class="liststyle">
                    <li>
                        <a href="#" data-dropdown="drop3">Voornaam Achternaam &raquo;</a>
                        <ul id="drop3" class="tiny f-dropdown" data-dropdown-content>
                            <li><a href="#">Naam spel</a></li>
                            <li><a href="#">Naam spel 2</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" data-dropdown="drop4">Voornaam Achternaam &raquo;</a>
                        <ul id="drop4" class="tiny f-dropdown" data-dropdown-content>
                            <li><a href="#">Naam spel</a></li>
                            <li><a href="#">Naam spel 2</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" data-dropdown="drop5">Voornaam Achternaam &raquo;</a>
                        <ul id="drop5" class="tiny f-dropdown" data-dropdown-content>
                            <li><a href="#">Naam spel</a></li>
                            <li><a href="#">Naam spel 2</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@stop