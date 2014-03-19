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
            <h1>Find your Play</h1>
        </div>
    </div>
</div>
<div class="main row">
    <div class="large-12 columns">
        @yield('content')
    </div>
</div>

@include('layouts.web.scripts')

</body>
</html>