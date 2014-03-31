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
    <div class="medium-6 columns spelzoeken">
        <div class="medium-8 columns right paddingfix widthfix">
            <h2>Spel zoeken</h2>
            <form>
                <div class="row collapse">
                    <div class="small-1 columns">
                        <span class="prefix"><i class="fi-page-search"></i></span>
                    </div>
                    <div class="small-11 columns">
                        <input type="text" placeholder="bvb. spelnaam">
                    </div>
                </div>
                <p><a href="#">Geavanceerd zoeken</a> <a href="#" class="button tiny right">Zoeken</a></p>
            </form>
        </div>
    </div>
    <div class="medium-6 columns aanmelden">
        <h2>Meld je aan</h2>
        <div class="medium-7 widthfix">
            <form>
                <div class="row collapse">
                    <div class="small-1 columns">
                        <span class="prefix"><i class="fi-torso"></i></span>
                    </div>
                    <div class="small-11 columns">
                        <input type="text" placeholder="Gebruikersnaam">
                    </div>
                </div>
                <div class="row collapse">
                    <div class="small-1 columns">
                        <span class="prefix"><i class="fi-lock"></i></span>
                    </div>
                    <div class="small-11 columns">
                        <input type="text" placeholder="Wachtwoord">
                    </div>
                </div>
                <p>Nog geen account? <a href="#">Registreer</a> <a href="#" class="button tiny right">Inloggen</a></p>
            </form>
        </div>
    </div>
</div>
@stop