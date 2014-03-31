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
            {{ HTML::image('css/images/logo.png', 'Find your Play', array('id' => 'logo')) }}
            <h1>Find your Play</h1>
            </div>
            <div class="profile">
                <p><i class="fi-torso"></i> <a href="#">Liesbeth</a> <span class="seperator">&#124;</span> NL &#124; EN</p>
            </div>
            <div class="navigation">
                <a href="#">Spellen zoeken</a>
                <a href="#">Over ons</a>
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
@yield('footer')

@include('layouts.web.scripts')

</body>
</html>