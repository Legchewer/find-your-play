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

{{-- TODO : LAYOUT --}}
<div id="header">
    <div class="row">
        <div class="logo small-8 columns clearfix">
            <a href="{{url('/')}}">
                {{ HTML::image('css/images/logo.png', 'Find your Play', ['class' => 'left', 'id' => 'logo', 'title' => 'Find your Play']) }}
                <h1>Find Your Play</h1>
            </a>
        </div>
        <div class="subnav small-4 columns">
            <ul class="inline-list right">
                @if(Auth::User())
                <li>
                    <a href="#" data-dropdown="drop">{{ Auth::user()->person->person_givenname }} <i class="fa fa-caret-down"></i></a>
                    <ul id="drop" class="tiny f-dropdown" data-dropdown-content>
                        <li><a href="{{url('/web/profiel')}}">Profiel</a></li>
                        <li><a href="{{url('/web/logout')}}">Uitloggen</a></li>
                    </ul>
                </li>
                <li class="divider">&nbsp;</li>
                @endif
                <li>
                    NL / EN
                </li>
            </ul>
        </div>

    </div>
</div>
<div class="row">
        @yield('content')
</div>
@yield('page_navigation')
<div class="row">
        @yield('contact')
</div>
<div id="footer">
    <div class="row">
        <p>&copy; 2014 MMP</p>
    </div>
</div>
@yield('login')

@include('layouts.web.scripts')

</body>
</html>