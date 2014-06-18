<?php
$version = [
    'select' => '3.4.5',
    'foundation' => '5.1.1',
    'fontawesome' => '4.0.3',
];
?>
<html>
@include('layouts.web.head')
<body>

<div class="page-wrap">
    <div id="header">
        <div class="row">
            <div class="logo small-8 columns clearfix">
                <a href="{{url('/')}}">
                    {{ HTML::image('css/images/logo.png', 'Find your Play', ['class' => 'left', 'id' => 'logo', 'title' => 'Find your Play']) }}
                    <h1>Find your Play</h1>
                </a>
            </div>
            <div class="subnav small-4 columns">
                <ul class="inline-list right">
                    @if(Auth::User())
                    <li>
                        @if (App::getLocale() == 'nl')
                        <a href="{{ URL::to('/web/about')}}">{{ Lang::get('web-index.header-link2') }}</a>
                        @else
                        <a href="{{ URL::to('/web/about')}}">{{ Lang::get('web-index.header-link2') }}</a>
                        @endif
                    </li>
                    <li class="divider">&nbsp;</li>
                    <li>
                        <a href="#" data-dropdown="dr0p">{{ Auth::user()->person->person_givenname }} <i class="fa fa-caret-down"></i></a>
                        <ul id="dr0p" class="tiny f-dropdown" data-dropdown-content>
                            <li><a href="{{ URL::to('/web/user/profile')}}">{{ Lang::get('web-index.profile-link1') }}</a></li>
                            <li><a href="{{ URL::to('/web/logout')}}">{{ Lang::get('web-index.profile-link2') }}</a></li>
                        </ul>
                    </li>
                    <li class="divider">&nbsp;</li>
                    @else
                    <li>
                        @if (App::getLocale() == 'nl')
                        <a href="{{ URL::to('/web/about')}}">{{ Lang::get('web-index.header-link2') }}</a>
                        @else
                        <a href="{{ URL::to('/web/about')}}">{{ Lang::get('web-index.header-link2') }}</a>
                        @endif
                    </li>
                    <li class="divider">&nbsp;</li>
                    <li>
                        @if (App::getLocale() == 'nl')
                        <a href="{{ URL::to('/web/signin')}}">{{ Lang::get('web-registreren.aanmelden') }}</a>
                        @else
                        <a href="{{ URL::to('/web/signin')}}">{{ Lang::get('web-registreren.aanmelden') }}</a>
                        @endif
                    </li>
                    <li class="divider">&nbsp;</li>
                    @endif
                    <li>
                        @if (App::getLocale() == 'nl')
                        {{ HTML::link('/web/language/nl', 'NL', ['class' => 'language']), PHP_EOL }}
                        @else
                        {{ HTML::link('/web/language/nl', 'NL', ['class' => 'language active']), PHP_EOL }}
                        @endif
                    </li>
                    <li>
                        @if (App::getLocale() == 'en')
                        {{ HTML::link('/web/language/en', 'EN', ['class' => 'language']), PHP_EOL }}
                        @else
                        {{ HTML::link('/web/language/en', 'EN', ['class' => 'language active']), PHP_EOL }}
                        @endif
                    </li>
                </ul>
            </div>

        </div>
    </div>
    <div class="row paddingfix1024">
        @yield('content')
    </div>
    @yield('page_navigation')
    <div class="row">
        @yield('contact')
    </div>
</div>
<div id="footer">
    <div class="row">
        <p>&copy; 2014 Find your Play</p>
    </div>
</div>

@include('layouts.web.scripts')

</body>
</html>