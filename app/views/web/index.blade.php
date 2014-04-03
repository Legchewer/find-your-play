@extends('layouts.web.master')

@section('content')
<div class="intro row" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
    <div class="medium-8 columns">
        <p>Lorem Ipsum is slechts een proeftekst uit het drukkerij- en zetterijwezen. Lorem Ipsum is de standaard proeftekst in deze bedrijfstak sinds de 16e eeuw, toen een onbekende drukker een zethaak met letters nam en ze door elkaar husselde om een font-catalogus te maken.</p>
        <p>Het heeft niet alleen vijf eeuwen overleefd maar is ook, vrijwel onveranderd, overgenomen in elektronische letterzetting. Het is in de jaren '60 populair geworden met de introductie van Letraset vellen met Lorem Ipsum passages en meer recentelijk door desktop publishing software zoals Aldus PageMaker die versies van Lorem Ipsum bevatten.</p>
    </div>
    <div class="medium-4 columns paddingfix">
        {{ HTML::image('http://lorempixel.com/400/200', 'Find your Play', array('id' => 'intro_img')) }}
    </div>
</div>
@stop

@section('page_navigation')
@if(!Auth::check())<div class="page_navigation">@else <div class="page_nav ">@endif
    <div class="row">
    <div class="row">
        @if(!Auth::check())
        <div class="medium-6 columns spelzoeken">
            <h2>Spel zoeken</h2>
            <form>
                <div class="row collapse">
                    <div class="small-2 medium-1 columns">
                        <span class="prefix"><i class="fa fa-search"></i></span>
                    </div>
                    <div class="small-10 medium-11 columns">
                        <input type="text" placeholder="bvb. spelnaam">
                    </div>
                </div>
                <p><a href="#">Geavanceerd zoeken</a> <a href="#" class="button tiny right">Zoeken</a></p>
            </form>
        </div>
        <div class="medium-6 columns aanmelden">
                <h2>Meld je aan</h2>

                @if(Session::has('auth-error-message'))
                <div class="alert-box alert alert-global" data-alert>
                    <span class="alert-msg">{{ Session::get('auth-error-message') }}</span>
                    <a href="#" class="close">&times;</a>
                </div>
                @endif

                {{ Form::open(['route' => 'web.auth']), PHP_EOL }}

                <div class="row collapse">
                    <div class="small-2 medium-1 columns">
                        <span class="prefix"><i class="fa fa-user"></i></span>
                    </div>
                    <div class="small-10 medium-11 columns">
                        {{ Form::email('email', '', ['placeholder' => 'Email adres','class' => ($errors->has('email') ? 'error' : '' )]) }}
                        @if ($errors->has('email'))
                        {{ $errors->first('email', '<small class="error">:message</small>') }}
                        @endif
                    </div>
                </div>
                <div class="row collapse">
                    <div class="small-2 medium-1 columns">
                        <span class="prefix"><i class="fa fa-lock"></i></span>
                    </div>
                    <div class="small-10 medium-11 columns">
                        {{ Form::password('password', ['placeholder' => 'Wachtwoord','class' => ($errors->has('password') ? 'error' : '' )]) }}
                        @if ($errors->has('password'))
                        {{ $errors->first('password', '<small class="error">:message</small>') }}
                        @endif
                    </div>
                </div>
                <p>Nog geen account? <a href="#">Registreer</a> {{ Form::submit('Inloggen', ['class' => 'button tiny right']), PHP_EOL }}</p>

                {{ Form::close(), PHP_EOL }}
            </div>
        @else
            <div class="columns">
                <h2>Spel zoeken</h2>
                <p>
                    Maak gebruik van onze zoekfunctie en vindt zo gemakkelijk wat u zoekt. Geef een zoekterm op en de spellen worden voor u weergegeven.
                    Als u gebruik wil maken van verschillende filters, klik dan op geavanceerd zoeken!
                </p>
                <form>
                    <div class="row collapse">
                        <div class="small-1 columns">
                            <span class="prefix"><i class="fa fa-search"></i></span>
                        </div>
                        <div class="small-11 columns">
                            <input type="text" placeholder="bvb. spelnaam">
                        </div>
                    </div>
                    <p><a href="#">Geavanceerd zoeken</a> <a href="#" class="button tiny right">Zoeken</a></p>
                </form>
            </div>
        @endif
        </div>
    </div>
</div>
@stop

@section('contact')
<div id="contact" class="row">
    <div class="medium-6 columns">
        <h2>Contact</h2>
        <p>Lorem Ipsum is slechts een proeftekst uit het drukkerij- en zetterijwezen. Lorem Ipsum is de standaard proeftekst in deze bedrijfstak sinds de 16e eeuw, toen een onbekende drukker een zethaak met letters nam en ze door elkaar husselde om een font-catalogus te maken.</p>
    </div>
    <div class="medium-6 columns contact">
        <h2>Vind ons op</h2>
        <ul class="inline-list">
            <li><a href="#"><i class="fa fa-youtube"></i></a></li>
            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
        </ul>
    </div>
</div>
@stop