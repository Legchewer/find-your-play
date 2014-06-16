@extends('layouts.admin.master')

@section('content')

{{-- modal window --}}
<div id="warning" class="reveal-modal" data-reveal>
    <h2>{{ Lang::get('modal.warning') }}</h2>
    <p class="lead">{{ Lang::get('modal.lead1') }}</p>
    <p>{{ Lang::get('modal.lead2') }}</p>
    <a id="warning-accept" class="button" href="#">{{ Lang::get('modal.continue') }}</a>
    <a class="button" href="">{{ Lang::get('modal.cancel') }}</a>
    <a class="close-reveal-modal">&#215;</a>
</div>

<div class="content difficulties">
    <div class="row">
        <div class="large-12 columns content-header">

            <h1><i class="fa fa-male"></i> {{ Lang::choice('admin-pages.players',1) }} <small>{{ Lang::get('admin-pages.players-sub') }}</small></h1>

            <span class="count">{{ $count }}</span>

        </div>
    </div>

    <div class="row">
        <div class="large-12 columns content list">

            <table class="players">
                <thead>
                <tr>
                    <th>{{ Lang::get('table_general.name') }}</th>
                    <th>{{ Lang::get('table_general.actions') }}</th>
                </tr>
                </thead>

                <tbody>

                {{-- LANGUAGE CHECK --}}
                @if (App::getLocale() == 'nl')

                    @foreach ($players as $players_s)
                    <tr class="players-row" id="players-row-{{ $players_s->game_players_id }}">
                        <td>
                            @if ($players_s->game_players_name_nl)
                                {{ $players_s->game_players_name_nl }}
                            @else
                                {{ '<span data-tooltip class="has-tip no-translation" title="Vertaling nodig" ><i class="fa fa-exclamation-triangle"></i>' . $players_s->game_players_name_en . '</span>' }}
                            @endif
                        </td>

                        <td>
                            <a href="{{ URL::route('admin.players.edit', [$players_s->game_players_id]) }}">
                                <span data-tooltip data-options="disable_for_touch:true" class="has-tip" title="Edit spelers"><i class="fa fa-pencil"></i></span>
                            </a>

                            <a class="confirm" data-reveal-id="warning" href="{{ URL::route('admin.players.destroy', [$players_s->game_players_id]) }}" >
                                <span data-tooltip data-options="disable_for_touch:true" class="has-tip" title="Permadelete spelers"><i class="fa fa-trash-o"></i></span>
                            </a>

                        </td>
                    </tr>
                    @endforeach

                @else

                    @foreach ($players as $players_s)
                    <tr class="players-row" id="players-row-{{ $players_s->game_players_id }}">
                        <td>
                            @if ($players_s->game_players_name_en)
                            {{ $players_s->game_players_name_en }}
                            @else
                            {{ '<span data-tooltip class="has-tip no-translation" title="Needs translation" ><i class="fa fa-exclamation-triangle"></i>' . $players_s->game_players_name_nl . '</span>' }}
                            @endif
                        </td>

                        <td>
                            <a href="{{ URL::route('admin.players.edit', [$players_s->game_players_id]) }}">
                                <span data-tooltip data-options="disable_for_touch:true" class="has-tip" title="Edit players"><i class="fa fa-pencil"></i></span>
                            </a>

                            <a class="confirm" data-reveal-id="warning" href="{{ URL::route('admin.players.destroy', [$players_s->game_players_id]) }}" >
                                <span data-tooltip data-options="disable_for_touch:true" class="has-tip" title="Permadelete players"><i class="fa fa-trash-o"></i></span>
                            </a>

                        </td>
                    </tr>
                    @endforeach

                @endif

                </tbody>
            </table>

            {{-- PAGER --}}
            <div class="pagination-centered">
                {{ $players->links() }}
            </div>

            <a href="{{ URL::route('admin.players.create') }}" class="button button-add"><i class="fa fa-plus"></i>{{ Lang::choice('table_general.add', 0, ['type' => strtolower(Lang::choice('admin-pages.players',0))]) }}</a>

        </div>
    </div>
</div>


@stop