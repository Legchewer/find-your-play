<?php
$version = [
    'select' => '3.4.5',
    'foundation' => '5.1.1',
];
?>
<html>
@include('layouts.admin.head')
<body>

{{-- TODO : LAYOUT --}}

<div class="main row">

    @yield('content')

</div>

@include('layouts.admin.scripts')

</body>
</html>