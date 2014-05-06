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

<div class="content games">
    <div class="row">
        <div class="large-12 columns content-header">

            <h1><i class="fa fa-puzzle-piece"></i> {{ Lang::choice('admin-pages.games',1) }} <small>{{ Lang::get('admin-pages.games-sub') }}</small></h1>

        </div>
    </div>

    <div class="row">
        <div class="large-12 columns content list">

            <table class="games">
                <thead>
                <tr>
                    <th>{{ Lang::get('table_general.more-info') }}</th>
                    <th>{{ Lang::get('table_specific.title') }}</th>
                    <th>{{ Lang::get('table_specific.type') }}</th>
                    <th>{{ Lang::get('table_specific.theme') }}</th>
                    <th>{{ Lang::get('table_specific.difficulty') }}</th>
                    <th>{{ Lang::get('table_specific.producer') }}</th>
                    <th>{{ Lang::get('table_specific.age') }}</th>
                    <th>{{ Lang::get('table_general.actions') }}</th>
                </tr>
                </thead>
                <tbody>

                {{-- LANGUAGE CHECK --}}
                @if (App::getLocale() == 'nl')

                    @foreach ($games as $game)
                    <tr class="game-row" id="game-row-{{ $game->game_id }}">

                        <td class="more-info">
                        <span data-tooltip class="has-tip tip-top" title="
                            {{ Lang::get('table_general.created') }}:
                            {{ $game->game_created }}
                            <br />
                            {{ Lang::get('table_general.modified') }}:
                            @if ($game->game_modified)
                                {{ $game->game_modified }}
                            @else
                                /
                            @endif
                            <br />
                            {{ Lang::get('table_general.deleted') }}:
                            @if ($game->game_deleted)
                                {{ $game->game_deleted }}
                            @else
                                /
                            @endif
                        "><i class="fa fa-info"></i></span>
                        </td>
                        <td>
                            @if ($game->game_title_nl)
                            {{ $game->game_title_nl }}
                            @else
                            {{ '<span data-tooltip class="has-tip no-translation" title="Vertaling nodig" ><i class="fa fa-exclamation-triangle"></i>' . $game->game_title_en . '</span>' }}
                            @endif
                        </td>

                        <td>
                            @if ($game->gameType->game_type_name_nl)
                            {{ $game->gameType->game_type_name_nl }}
                            @else
                            {{ '<span data-tooltip class="has-tip no-translation" title="Vertaling nodig" ><i class="fa fa-exclamation-triangle"></i>' . $game->gameType->game_type_name_en . '</span>' }}
                            @endif
                        </td>

                        <td>
                            @if ($game->theme->theme_name_nl)
                            {{ $game->theme->theme_name_nl }}
                            @else
                            {{ '<span data-tooltip class="has-tip no-translation" title="Vertaling nodig" ><i class="fa fa-exclamation-triangle"></i>' . $game->theme->theme_name_en . '</span>' }}
                            @endif
                        </td>

                        <td>
                            @if ($game->gameDifficulty->game_difficulty_name_nl)
                            {{ $game->gameDifficulty->game_difficulty_name_nl }}
                            @else
                            {{ '<span data-tooltip class="has-tip no-translation" title="Vertaling nodig" ><i class="fa fa-exclamation-triangle"></i>' . $game->gameDifficulty->game_difficulty_name_en . '</span>' }}
                            @endif
                        </td>

                        <td>
                            @if ($game->game_producer)
                            {{ $game->game_producer }}
                            @endif
                        </td>

                        <td>
                            @if ($game->game_age_nl)
                            {{ $game->game_age_nl }}
                            @else
                            {{ '<span data-tooltip class="has-tip no-translation" title="Vertaling nodig" ><i class="fa fa-exclamation-triangle"></i>' . $game->game_age_en . '</span>' }}
                            @endif
                        </td>

                        <td>
                            <a href="{{-- URL::route('admin.games.edit', [$game->game_id]) --}}">
                                <span data-tooltip class="has-tip" title="Edit spel"><i class="fa fa-pencil"></i></span>
                            </a>

                            <a class="confirm" data-reveal-id="warning" href="{{ URL::route('admin.games.destroy', [$game->game_id]) }}" >
                                <span data-tooltip class="has-tip" title="Permadelete spel"><i class="fa fa-trash-o"></i></span>
                            </a>

                        </td>
                    </tr>
                    @endforeach

                @else

                    @foreach ($games as $game)
                    <tr class="game-row" id="game-row-{{ $game->game_id }}">

                        <td class="more-info">
                        <span data-tooltip class="has-tip tip-top" title="
                            {{ Lang::get('table_general.created') }}:
                            {{ $game->game_created }}
                            <br />
                            {{ Lang::get('table_general.modified') }}:
                            @if ($game->game_modified)
                                {{ $game->game_modified }}
                            @else
                                /
                            @endif
                            <br />
                            {{ Lang::get('table_general.deleted') }}:
                            @if ($game->game_deleted)
                                {{ $game->game_deleted }}
                            @else
                                /
                            @endif
                        "><i class="fa fa-info"></i></span>
                        </td>
                        <td>
                            @if ($game->game_title_en)
                            {{ $game->game_title_en }}
                            @else
                            {{ '<span data-tooltip class="has-tip no-translation" title="Needs translation" ><i class="fa fa-exclamation-triangle"></i>' . $game->game_title_nl . '</span>' }}
                            @endif
                        </td>

                        <td>
                            @if ($game->gameType->game_type_name_en)
                            {{ $game->gameType->game_type_name_en }}
                            @else
                            {{ '<span data-tooltip class="has-tip no-translation" title="Needs translation" ><i class="fa fa-exclamation-triangle"></i>' . $game->gameType->game_type_name_nl . '</span>' }}
                            @endif
                        </td>

                        <td>
                            @if ($game->theme->theme_name_en)
                            {{ $game->theme->theme_name_en }}
                            @else
                            {{ '<span data-tooltip class="has-tip no-translation" title="Needs translation" ><i class="fa fa-exclamation-triangle"></i>' . $game->theme->theme_name_nl . '</span>' }}
                            @endif
                        </td>

                        <td>
                            @if ($game->gameDifficulty->game_difficulty_name_en)
                            {{ $game->gameDifficulty->game_difficulty_name_en }}
                            @else
                            {{ '<span data-tooltip class="has-tip no-translation" title="Needs translation" ><i class="fa fa-exclamation-triangle"></i>' . $game->gameDifficulty->game_difficulty_name_nl . '</span>' }}
                            @endif
                        </td>

                        <td>
                            @if ($game->game_producer)
                            {{ $game->game_producer }}
                            @endif
                        </td>

                        <td>
                            @if ($game->game_age_en)
                            {{ $game->game_age_en }}
                            @else
                            {{ '<span data-tooltip class="has-tip no-translation" title="Needs translation" ><i class="fa fa-exclamation-triangle"></i>' . $game->game_age_nl . '</span>' }}
                            @endif
                        </td>

                        <td>
                            <a href="{{-- URL::route('admin.games.edit', [$game->game_id]) --}}">
                                <span data-tooltip class="has-tip" title="Edit game"><i class="fa fa-pencil"></i></span>
                            </a>

                            <a class="confirm" data-reveal-id="warning" href="{{ URL::route('admin.games.destroy', [$game->game_id]) }}" >
                                <span data-tooltip class="has-tip" title="Permadelete game"><i class="fa fa-trash-o"></i></span>
                            </a>

                        </td>
                    </tr>
                    @endforeach

                @endif

                </tbody>
            </table>

            {{-- PAGER --}}
            <div class="pagination-centered">
                {{ $games->links() }}
            </div>

            <a href="{{ URL::route('admin.games.create') }}" class="button button-add"><i class="fa fa-plus"></i>{{ Lang::choice('table_general.add', 1, ['type' => strtolower(Lang::choice('admin-pages.games',0))]) }}</a>

        </div>
    </div>
</div>


@stop