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

<div class="content kinds">
    <div class="row">
        <div class="large-12 columns content-header">

            <h1><i class="fa fa-clipboard"></i> {{ Lang::get('admin-pages.kinds') }} <small>{{ Lang::get('admin-pages.kinds-sub') }}</small></h1>

        </div>
    </div>

    <div class="row">
        <div class="large-12 columns content list">

            <table class="kinds">
                <thead>
                <tr>
                    <th>{{ Lang::get('table_general.name') }}</th>
                    <th>{{ Lang::get('table_general.actions') }}</th>
                </tr>
                </thead>
                <tbody>

                {{-- LANGUAGE CHECK --}}
                @if (App::getLocale() == 'nl')

                    @foreach ($kinds as $kind)
                    <tr class="kind-row" id="kind-row-{{ $kind->game_kind_id }}">
                        <td>
                            @if ($kind->game_kind_name_nl)
                            {{ $kind->game_kind_name_nl }}
                            @else
                            {{ '<span data-tooltip class="has-tip no-translation" title="Vertaling nodig" ><i class="fa fa-exclamation-triangle"></i>' . $kind->game_kind_name_en . '</span>' }}
                            @endif
                        </td>

                        <td>
                            <a href="{{-- URL::route('admin.kinds.edit', [$kind->game_kind_id]) --}}">
                                <span data-tooltip class="has-tip" title="Edit spelsoort"><i class="fa fa-pencil"></i></span>
                            </a>

                            <a class="confirm" data-reveal-id="warning" href="{{-- URL::route('admin.kinds.destroy', [$kind->game_kind_id]) --}}" >
                                <span data-tooltip class="has-tip" title="Permadelete spelsoort"><i class="fa fa-trash-o"></i></span>
                            </a>

                        </td>
                    </tr>
                    @endforeach

                @else

                @foreach ($kinds as $kind)
                <tr class="kind-row" id="kind-row-{{ $kind->game_kind_id }}">
                    <td>
                        @if ($kind->game_kind_name_en)
                        {{ $kind->game_kind_name_en }}
                        @else
                        {{ '<span data-tooltip class="has-tip no-translation" title="Needs translation" ><i class="fa fa-exclamation-triangle"></i>' . $kind->game_kind_name_nl . '</span>' }}
                        @endif
                    </td>

                    <td>
                        <a href="{{-- URL::route('admin.kinds.edit', [$kind->game_kind_id]) --}}">
                            <span data-tooltip class="has-tip" title="Edit kind"><i class="fa fa-pencil"></i></span>
                        </a>

                        <a class="confirm" data-reveal-id="warning" href="{{-- URL::route('admin.kinds.destroy', [$kind->game_kind_id]) --}}" >
                            <span data-tooltip class="has-tip" title="Permadelete kind"><i class="fa fa-trash-o"></i></span>
                        </a>

                    </td>
                </tr>
                @endforeach

                @endif

                </tbody>
            </table>

            {{-- PAGER --}}
            <div class="pagination-centered">
                {{ $kinds->links() }}
            </div>

        </div>
    </div>
</div>


@stop