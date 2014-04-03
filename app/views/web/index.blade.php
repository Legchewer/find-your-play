@extends('layouts.web.master')

@section('content')
<div class="intro row">
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
<div class="page_navigation">
    <div class="row">
    <div class="row">
        <div class="medium-6 columns spelzoeken">
            <h2>Spel zoeken</h2>
            <form>
                <div class="row collapse">
                    <div class="small-2 medium-1 columns">
                        <span class="prefix"><i class="fi-page-search"></i></span>
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
            @if ($errors->any())
            <div class="alert-box alert" data-alert>
                <ul class="no-bullet">
                    @foreach ($errors->all('<li>:message</li>' . PHP_EOL) as $message)
                    {{ $message }}
                    @endforeach
                </ul>
                <a href="#" class="close">&times;</a>
            </div>
            @endif

            @if(Session::has('auth-error-message'))
            <div class="alert-box alert" data-alert>
                <span class="alert-msg">{{ Session::get('auth-error-message') }}</span>
                <a href="#" class="close">&times;</a>
            </div>
            @endif

            {{ Form::open(['route' => 'web.auth']), PHP_EOL }}

            <div class="row collapse">
                <div class="small-2 medium-1 columns">
                    <span class="prefix"><i class="fi-torso"></i></span>
                </div>
                <div class="small-10 medium-11 columns">
                    {{ Form::email('email', '', ['placeholder' => 'Email adres']) }}
                </div>
            </div>
            <div class="row collapse">
                <div class="small-2 medium-1 columns">
                    <span class="prefix"><i class="fi-lock"></i></span>
                </div>
                <div class="small-10 medium-11 columns">
                    {{ Form::password('password', ['placeholder' => 'Wachtwoord']) }}
                </div>
            </div>
            <p>Nog geen account? <a href="#">Registreer</a> {{ Form::submit('Inloggen', ['class' => 'button tiny right']), PHP_EOL }}</p>

            {{ Form::close(), PHP_EOL }}
        </div>
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
            <li><a href="#"><i class="fi-social-youtube"></i></a></li>
            <li><a href="#"><i class="fi-social-facebook"></i></a></li>
            <li><a href="#"><i class="fi-social-twitter"></i></a></li>
            <li><a href="#"><i class="fi-social-linkedin"></i></a></li>
        </ul>
    </div>
</div>
@stop