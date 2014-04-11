<?php
$version = [
    'select' => '3.4.5',
    'foundation' => '5.1.1',
    'fa' => '4.0.3'
];
?>
<html>
@include('layouts.admin.head')
<body>

<div class="header row">
    <div class="logo large-8 medium-8 small-8 columns clearfix">
        <a href="{{ URL::route('admin.dashboard') }}" alt="dashboard" >{{ HTML::image('images/logo-admin.png', 'Find your Play', ['class' => 'left', 'title' => 'Find your Play']) }}</a>
        <h1 class="hide">Find Your Play Admin</h1>
    </div>
    <div class="subnav large-4 medium-4 small-4 columns">
        <ul class="inline-list right">
            <li>
                {{ Lang::get('admin-general.welcome') }} {{ Auth::user()->person->person_givenname }}
            </li>
            <li class="divider">&nbsp;</li>
            <li>
                {{ HTML::link('/admin/logout', Lang::get('admin-general.logout'), ['' => '']), PHP_EOL }}
            </li>
        </ul>
    </div>

</div>
<div class="fw-container-nav">
    <div class="main-nav row">
        <nav>
            <ul class="nav-list">
                <li class="large-4 medium-4 columns first">
                    <a data-dropdown="drop1" class="dropdown active" href=""><i class="fa fa-puzzle-piece fa-lg"></i> {{ Lang::get('admin-pages.games') }}</a>
                    <ul id="drop1" data-dropdown-content class="f-dropdown">
                        <li><a href="#"><i class="fa fa-puzzle-piece"></i> {{ Lang::get('admin-pages.games') }}</a></li>
                        <li><a href="#"><i class="fa fa-clipboard"></i> {{ Lang::get('admin-pages.kinds') }}</a></li>
                        <li><a href="#"><i class="fa fa-folder-open"></i> {{ Lang::get('admin-pages.types') }}</a></li>
                        <li><a href="{{ URL::route('admin.themes') }}"><i class="fa fa-rocket"></i> {{ Lang::get('admin-pages.themes') }}</a></li>
                        <li><a href="#"><i class="fa fa-lightbulb-o"></i> {{ Lang::get('admin-pages.functions') }}</a></li>
                        <li><a href="#"><i class="fa fa-book"></i> {{ Lang::get('admin-pages.function-categories') }}</a></li>
                        <li><a href="#"><i class="fa fa-bar-chart-o"></i> {{ Lang::get('admin-pages.difficulties') }}</a></li>
                        <li><a href="#"><i class="fa fa-money"></i> {{ Lang::get('admin-pages.budget-groups') }}</a></li>
                        <li><a href="#"><i class="fa fa-comments"></i> Feedback</a></li>
                    </ul>
                </li>
                <li class="large-4 medium-4 columns second">
                    <a data-dropdown="drop2" class="dropdown" href=""><i class="fa fa-users fa-lg"></i> {{ Lang::get('admin-pages.members') }}</a>
                    <ul id="drop2" data-dropdown-content class="f-dropdown">
                        <li><a href="#"><i class="fa fa-users"></i> {{ Lang::get('admin-pages.members') }}</a></li>
                        <li><a href="#"><i class="fa fa-user"></i> {{ Lang::get('admin-pages.roles') }}</a></li>
                    </ul>
                </li>
                <li class="large-4 medium-4 columns last">
                    <a href="#"><i class="fa fa-cogs fa-lg"></i> {{ Lang::get('admin-pages.settings') }}</a>
                </li>
            </ul>
        </nav>
    </div>
</div>
<div class="fw-container-main">
            @yield('content')
</div>

<div class="fw-container-footer">
    <div class="footer row">
        <p>Copyright &copy; Find your Play. Alle rechten voorbehouden.</p>
    </div>
</div>

@include('layouts.admin.scripts')

</body>
</html>