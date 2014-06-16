@extends('layouts.admin.master')

@section('content')

<div class="content dashboard">
    <div class="row">
        <div class="large-12 columns content-header">

            <h1><i class="fa fa-dashboard"></i> Dashboard <small>{{ Lang::get('admin-pages.dashboard-sub') }}</small></h1>

            <div class="dashboard-info row">

                {{-- LANGUAGE CHECK --}}
                @if (App::getLocale() == 'nl')

                    <div class="dashboard-info-panel columns large-6">
                        <div class="panel-header"><h2>{{ Lang::choice('admin-pages.games',1) }} <i class="fa fa-puzzle-piece fa-lg"></i></h2></div>
                        <div class="panel-content">
                            <ul>
                                <li>Aantal spelletjes: {{ $games_count }}</li>
                                <li>Laatst toegevoegd: {{ $latest_game_added }}</li>
                                <li>Datum laatst toegevoegd: {{ date("d/m/Y", strtotime($latest_game_added_date)) }}</li>
                                <li>Laatst aangepast: {{ $latest_game_modified }}</li>
                                <li>Datum laatst aangepast: {{ date("d/m/Y", strtotime($latest_game_modified_date)) }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="dashboard-info-panel columns large-6">
                        <div class="panel-header"><h2>{{ Lang::choice('admin-pages.members',1) }} <i class="fa fa-users fa-lg"></i></h2></div>
                        <div class="panel-content">
                            <ul>
                                <li>Aantal leden: {{ $members_count }}</li>
                                <li>Laatst toegevoegd: {{ $latest_member_added }}</li>
                                <li>Datum laatst toegevoegd: {{ date("d/m/Y", strtotime($latest_member_added_date)) }}</li>
                                <li>Rol: {{ $latest_member_added_role }}</li>
                            </ul>
                        </div>
                    </div>

                @else

                <div class="dashboard-info-panel columns large-6">
                    <div class="panel-header"><h2>{{ Lang::choice('admin-pages.games',1) }}</h2></div>
                    <div class="panel-content">
                        <ul>
                            <li>Number of games: {{ $games_count }}</li>
                            <li>Last added: {{ $latest_game_added }}</li>
                            <li>Last added date: {{ date("d/m/Y", strtotime($latest_game_added_date)) }}</li>
                            <li>Last modified: {{ $latest_game_modified }}</li>
                            <li>Last modified date: {{ date("d/m/Y", strtotime($latest_game_modified_date)) }}</li>
                        </ul>
                    </div>
                </div>
                <div class="dashboard-info-panel columns large-6">
                    <div class="panel-header"><h2>{{ Lang::choice('admin-pages.members',1) }}</h2></div>
                    <div class="panel-content">
                        <ul>
                            <li>Number of members: {{ $members_count }}</li>
                            <li>Last added: {{ $latest_member_added }}</li>
                            <li>Last added date: {{ date("d/m/Y", strtotime($latest_member_added_date)) }}</li>
                            <li>Role: {{ $latest_member_added_role }}</li>
                        </ul>
                    </div>
                </div>

                @endif

            </div>

        </div>
    </div>
</div>

@stop