<?php
$version = [
    'select' => '3.4.5',
    'foundation' => '5.1.1',
];
?>
<html>
@include('layouts.admin.head')
<body>

<div class="header row">
    <div class="logo large-12 medium-12 small-12 columns clearfix">
        {{ HTML::image('images/logo-admin.png', 'Find your Play', ['class' => 'left', 'title' => 'Find your Play']) }}
        <h1 class="hide">Find Your Play Admin</h1>
    </div>


</div>
<div class="fw-container-main">
    <div class="main row">
        <div class="content large-12 columns">
            @yield('content')
        </div>
    </div>
</div>

<div class="fw-container-footer">
    <div class="footer row">
        <p>Copyright &copy; Find your Play. Alle rechten voorbehouden.</p>
    </div>
</div>

@include('layouts.admin.scripts')

</body>
</html>