@extends('layouts.web.master')

@section('content')
<div class="row breadcrumb">
    <div class="small-12 columns">
        <ul class="breadcrumbs">
            <li><a href="{{ url('/')}}">Home</a></li>
            <li class="current"><a href="#">{{ Lang::get('web-about.breadcrumb')}}</a></li>
        </ul>
    </div>
</div>
<div class="intro row">
    <div class="medium-8 columns">
        <p>{{ Lang::get('web-about.intro-part1')}}</p>
    </div>
    <div class="medium-4 columns">
        {{ HTML::image('http://lorempixel.com/400/200', 'Find your Play', array('id' => 'intro_img')) }}
    </div>
</div>
<div class="intro row">
    <div class="medium-8 columns">
        <p>{{ Lang::get('web-about.intro-part2')}}</p>
    </div>
    <div class="medium-4 columns">
        {{ HTML::image('http://lorempixel.com/400/200', 'Find your Play', array('id' => 'intro_img')) }}
    </div>
</div>
<div class="intro row">
    <div class="medium-8 columns">
        <p>{{ Lang::get('web-about.intro-part3')}}</p>
    </div>
    <div class="medium-4 columns">
        {{ HTML::image('http://lorempixel.com/400/200', 'Find your Play', array('id' => 'intro_img')) }}
    </div>
</div>
@stop