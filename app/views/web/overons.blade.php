@extends('layouts.web.master')

@section('content')
<div class="row breadcrumb">
    <div class="small-12 columns">
        <ul class="breadcrumbs">
            <li><a href="{{ url('/')}}">Home</a></li>
            <li class="current"><a href="#">Over ons</a></li>
        </ul>
    </div>
</div>
<div class="intro row">
    <div class="medium-8 columns">
        <p>Lorem Ipsum is slechts een proeftekst uit het drukkerij- en zetterijwezen. Lorem Ipsum is de standaard proeftekst in deze bedrijfstak sinds de 16e eeuw, toen een onbekende drukker een zethaak met letters nam en ze door elkaar husselde om een font-catalogus te maken.</p>
    </div>
    <div class="medium-4 columns">
        {{ HTML::image('http://lorempixel.com/400/200', 'Find your Play', array('id' => 'intro_img')) }}
    </div>
</div>
<div class="intro row">
    <div class="medium-8 columns">
        <p>Lorem Ipsum is slechts een proeftekst uit het drukkerij- en zetterijwezen. Lorem Ipsum is de standaard proeftekst in deze bedrijfstak sinds de 16e eeuw, toen een onbekende drukker een zethaak met letters nam en ze door elkaar husselde om een font-catalogus te maken.</p>
    </div>
    <div class="medium-4 columns">
        {{ HTML::image('http://lorempixel.com/400/200', 'Find your Play', array('id' => 'intro_img')) }}
    </div>
</div>
<div class="intro row">
    <div class="medium-8 columns">
        <p>Lorem Ipsum is slechts een proeftekst uit het drukkerij- en zetterijwezen. Lorem Ipsum is de standaard proeftekst in deze bedrijfstak sinds de 16e eeuw, toen een onbekende drukker een zethaak met letters nam en ze door elkaar husselde om een font-catalogus te maken.</p>
    </div>
    <div class="medium-4 columns">
        {{ HTML::image('http://lorempixel.com/400/200', 'Find your Play', array('id' => 'intro_img')) }}
    </div>
</div>
@stop