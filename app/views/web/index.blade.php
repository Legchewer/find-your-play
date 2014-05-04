@extends('layouts.web.master')

@section('content')
<div class="intro row" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
    <div class="medium-8 columns">
        <p>{{ Lang::get('web-index.intro-content-part1') }}</p>
        <p>{{ Lang::get('web-index.intro-content-part2') }}</p>
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
            <h2>{{ Lang::get('web-index.search-header') }}</h2>
            <form>
                <div class="row collapse">
                    <div class="small-2 medium-1 columns">
                        <span class="prefix"><i class="fa fa-search"></i></span>
                    </div>
                    <div class="small-10 medium-11 columns">
                        <input type="text" placeholder="{{ Lang::get('web-index.search-placeholder') }}">
                    </div>
                </div>
                <p><a href="#">{{ Lang::get('web-index.search-link') }}</a> <a href="#" class="button tiny right">{{ Lang::get('web-index.search-button') }}</a></p>
            </form>
        </div>
        <div class="medium-6 columns aanmelden">
                <h2>{{ Lang::get('web-index.login-header') }}</h2>

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
                        {{ Form::email('email', '', ['placeholder' => Lang::get('web-index.login-email-placeholder'),'class' => ($errors->has('email') ? 'error' : '' )]) }}
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
                        {{ Form::password('password', ['placeholder' => Lang::get('web-index.login-password-placeholder'),'class' => ($errors->has('password') ? 'error' : '' )]) }}
                        @if ($errors->has('password'))
                        {{ $errors->first('password', '<small class="error">:message</small>') }}
                        @endif
                    </div>
                </div>
                <p>{{ Lang::get('web-index.login-link-pretext') }} <a href="{{ URL::to('web/user/register')}}">{{ Lang::get('web-index.login-link') }}</a> {{ Form::submit('Inloggen', ['class' => 'button tiny right']), PHP_EOL }}</p>

                {{ Form::close(), PHP_EOL }}
            </div>
        @else
                <div class="medium-6 columns">
                    <h2>{{ Lang::get('web-index.search-header') }}</h2>
                    <p>{{ Lang::get('web-index.search-text') }}</p>
                </div>
                <div class="medium-6 columns small-search">
                    <h2 class="show-for-medium-up">&nbsp;</h2>
                    {{ Form::open(['route' => 'web.search']), PHP_EOL }}
                        <div class="row collapse">
                            <div class="small-2 medium-1 columns">
                                <span class="prefix"><i class="fa fa-search"></i></span>
                            </div>
                            <div class="small-10 medium-11 columns">
                                {{ Form::text('game','', ['placeholder' => Lang::get('web-index.search-placeholder')]) }}
                            </div>
                        </div>
                        <p><a href="{{URL::to('web/search')}}">{{ Lang::get('web-index.search-link') }}</a> {{ Form::submit(Lang::get('web-index.search-button'), ['class' => 'button tiny right']), PHP_EOL }}</a></p>
                    {{ Form::close(), PHP_EOL }}
                </div>
        @endif
        </div>
    </div>
</div>
@stop

@section('contact')
<div id="contact" class="row">
    <div class="medium-6 columns">
        <h2>{{ Lang::get('web-index.contact-header') }}</h2>
        <p>{{ Lang::get('web-index.contact-content') }}</p>
    </div>
    <div class="medium-6 columns contact">
        <h2>{{ Lang::get('web-index.socialmedia-header') }}</h2>
        <ul class="inline-list">
            <li><a href="#"><i class="fa fa-youtube"></i></a></li>
            <li><a href="https://www.facebook.com/pages/Find-Your-Play/1399581420323425?ref=stream"><i class="fa fa-facebook"></i></a></li>
            <li><a href="https://twitter.com/Find_Your_Play"><i class="fa fa-twitter"></i></a></li>
            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
        </ul>
    </div>
</div>
@stop