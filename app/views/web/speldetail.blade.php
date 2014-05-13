@extends('layouts.web.master')

@section('content')
<div class="row">
    <div class="small-12 columns">
        <ul class="breadcrumbs">
            <li><a href="{{ url('/')}}">Home</a></li>
            <li><a href="{{ url('/search')}}">{{ Lang::get('web-zoeken.breadcrumb')}}</a></li>
            <li class="current">Nijntje vormenstoof</li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="small-12 columns detailspel">
        <dl class="tabs vertical" data-tab>
            <dd class="active"><a href="#panel1a">Algemene info</a></dd>
            <dd><a href="#panel2a">Kenmerken</a></dd>
            <dd><a href="#panel3a">Functies</a></dd>
            <dd><a href="#panel4a">Aankoop</a></dd>
        </dl>
        <div class="tabs-content vertical">
            <div class="content active" id="panel1a">
                <label>Spelsoort</label> <p>Puzzel</p>
                <label>Type</label> <p>Vormenstoof</p>
                <label>Spelers</label> <p>1</p>
                <label>Aangegeven speelduur</label> <p>15'</p>
                <label>Vanaf</label> <p>3 jaar</p>
            </div>
            <div class="content" id="panel2a">
                <label>Spelidee</label> <p>???</p>
                <label>Thema</label> <p>Nijntje - konijn - boerderij</p>
                <label>Afmeting puzzel</label> <p>L - 50cm / B - 30cm / H - 0cm</p>
                <label>Gemiddelde grootte stukken</label> <p>4cm</p>
                <label>Aantal stukken</label> <p>10</p>
                <label>Vorm stukken</label> <p>???</p>
                <label>Materiaal</label> <p>Kunststof</p>
                <label>Systeem verbinding</label> <p>Geen verbinding</p>
                <label>Kan in doos worden gemaakt</label> <p>Niet van toepassing</p>
                <label>Afbeelding</label> <p>Neen</p>
                <label>Abstract/concreet</label> <p>Abstract</p>
                <label>Detail</label> <p>Weinig</p>
                <label>Figuur-achtergrond</label> <p>Duidelijk</p>
                <label>Niveau</label> <p>Gemakkelijk</p>
                <label>Sfeer</label> <p>Ambiance</p>
                <label>Geluksfactor</label> <p>Gemiddeld</p>
                <label>Kleurcontrast</label> <p>???</p>
                <label>Variatie</label> <p>???</p>
            </div>
            <div class="content" id="panel3a">
                <label>Cognitief</label> <p>Geheugen</p>
                <label>Fysiek</label> <p>Fijne motoriek / coördinatie</p>
                <label>Sociaal</label> <p>Alleen</p>
                <label>Emotioneel</label> <p>Aanpassingsvermogen</p>
            </div>
            <div class="content" id="panel4a">
                <label>Richtprijs</label> <p>€ 15.00</p>
                <label>Producent</label> <p>Ravensburger</p>
                <label>Beschikbaarheid</label> <a href="{{url('https://www.ravensburger.com')}}" title="www.ravensburger.com">www.ravensburger.com</a>
            </div>
        </div>
    </div>
</div>
@stop