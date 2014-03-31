<?php
$version = [
    'select' => '3.4.5',
    'foundation' => '5.1.1',
];
?>
<html>
@include('layouts.web.head')
<body>

{{-- TODO : LAYOUT --}}
<div id="header">
    <div class="row">
        <div class="large-12 columns">
            <div class="logo">
                <a href="{{url('/')}}">{{ HTML::image('css/images/logo.png', 'Find your Play', array('id' => 'logo')) }}
                    <h1>Find your Play</h1>
                </a>

            </div>
            <div class="profile">
                <p><i class="fi-torso"></i> <a href="profiel">Liesbeth</a> <span class="seperator">&#124;</span> NL &#124; EN</p>
            </div>
            <div class="navigation">
                <a href="#">Spellen zoeken</a>
                <a href="about">Over ons</a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="large-12 columns">
        @yield('content')
    </div>
</div>
@yield('page_navigation')
<div class="row">
    <div class="large-12 columns">
        @yield('contact')
    </div>
</div>
<div id="footer">
    <p>&copy; 2014 MMP</p>
</div>

@include('layouts.web.scripts')

</body>
</html>