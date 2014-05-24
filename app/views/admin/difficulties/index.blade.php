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

            <h1><i class="fa fa-bar-chart-o"></i> {{ Lang::choice('admin-pages.difficulties',1) }} <small>{{ Lang::get('admin-pages.difficulties-sub') }}</small></h1>

        </div>
    </div>

    <div class="row">
        <div class="large-12 columns content list">

            <table class="difficulties">
                <thead>
                <tr>
                    <th>{{ Lang::get('table_general.name') }}</th>
                    <th>{{ Lang::get('table_general.actions') }}</th>
                </tr>
                </thead>
                <tbody>

                {{-- LANGUAGE CHECK --}}
                @if (App::getLocale() == 'nl')

                    @foreach ($difficulties as $difficulty)
                    <tr class="difficulty-row" id="difficulty-row-{{ $difficulty->game_difficulty_id }}">
                        <td>
                            @if ($difficulty->game_difficulty_name_nl)
                            {{ $difficulty->game_difficulty_name_nl }}
                            @else
                            {{ '<span data-tooltip class="has-tip no-translation" title="Vertaling nodig" ><i class="fa fa-exclamation-triangle"></i>' . $difficulty->game_difficulty_name_en . '</span>' }}
                            @endif
                        </td>

                        <td>
                            <a href="{{ URL::route('admin.difficulties.edit', [$difficulty->game_difficulty_id]) }}">
                                <span data-tooltip class="has-tip" title="Edit moeilijkheidsgraad"><i class="fa fa-pencil"></i></span>
                            </a>

                            <a class="confirm" data-reveal-id="warning" href="{{ URL::route('admin.difficulties.destroy', [$difficulty->game_difficulty_id]) }}" >
                                <span data-tooltip class="has-tip" title="Permadelete moeilijkheidsgraad"><i class="fa fa-trash-o"></i></span>
                            </a>

                        </td>
                    </tr>
                    @endforeach

                @else

                    @foreach ($difficulties as $difficulty)
                    <tr class="difficulty-row" id="difficulty-row-{{ $difficulty->game_difficulty_id }}">
                        <td>
                            @if ($difficulty->game_difficulty_name_en)
                            {{ $difficulty->game_difficulty_name_en }}
                            @else
                            {{ '<span data-tooltip class="has-tip no-translation" title="Needs translation" ><i class="fa fa-exclamation-triangle"></i>' . $difficulty->game_difficulty_name_nl . '</span>' }}
                            @endif
                        </td>

                        <td>
                            <a href="{{ URL::route('admin.difficulties.edit', [$difficulty->game_difficulty_id]) }}">
                                <span data-tooltip class="has-tip" title="Edit difficulty"><i class="fa fa-pencil"></i></span>
                            </a>

                            <a class="confirm" data-reveal-id="warning" href="{{ URL::route('admin.difficulties.destroy', [$difficulty->game_difficulty_id]) }}" >
                                <span data-tooltip class="has-tip" title="Permadelete difficulty"><i class="fa fa-trash-o"></i></span>
                            </a>

                        </td>
                    </tr>
                    @endforeach

                @endif

                </tbody>
            </table>

            {{-- PAGER --}}
            <div class="pagination-centered">
                {{ $difficulties->links() }}
            </div>

            <a href="{{ URL::route('admin.difficulties.create') }}" class="button button-add"><i class="fa fa-plus"></i>{{ Lang::choice('table_general.add', 0, ['type' => strtolower(Lang::choice('admin-pages.difficulties',0))]) }}</a>

        </div>
    </div>
</div>


@stop