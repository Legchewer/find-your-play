@extends('layouts.web.master')

@section('content')
<div class="row breadcrumb">
    <div class="small-12 columns paddingfix">
        <ul class="breadcrumbs">
            <li><a href="{{ url('/')}}">Home</a></li>
            <li class="unactive">Profiel</li>
            <li class="current"><a href="#">Liesbeth</a></li>
        </ul>
    </div>
</div>
<div id="profiel">
    <div class="row">
        <div class="small-12 medium-6 columns">
            <h2>Profiel</h2>
            <p>Lorem Ipsum is slechts een proeftekst uit het drukkerij- en zetterijwezen. Lorem Ipsum is de standaard proeftekst in deze bedrijfstak sinds de 16e eeuw, toen een onbekende drukker een zethaak met letters nam en ze door elkaar husselde om een font-catalogus te maken.</p>
        </div>
        <div class="small-12 medium-6 columns">
            <h2 class="alignfix">Aanpassen <i class="fi-page-edit"></i></h2>
            <ul>
                <li>Lorem Ipsum is slechts een proeftekst uit het drukkerij- en zetterijwezen.</li>
                <li>Lorem Ipsum is slechts een proeftekst uit het drukkerij- en zetterijwezen.</li>
                <li>Lorem Ipsum is slechts een proeftekst uit het drukkerij- en zetterijwezen.</li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="small-12 medium-6 columns">
            <div class="panel_blue">
                <div class="panel_title">
                    <h3>Fiches <i class="right fi-torso"></i></h3>
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
                    <h3>Verlanglijst <i class="right fi-star"></i></h3>
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