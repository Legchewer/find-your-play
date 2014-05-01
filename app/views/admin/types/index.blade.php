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

<div class="content types">
    <div class="row">
        <div class="large-12 columns content-header">

            <h1><i class="fa fa-folder-open"></i> {{ Lang::choice('admin-pages.types',1) }} <small>{{ Lang::get('admin-pages.types-sub') }}</small></h1>

        </div>
    </div>

    <div class="row">
        <div class="large-12 columns content list">

            <table class="types">
                <thead>
                <tr>
                    <th>{{ Lang::get('table_general.name') }}</th>
                    <th>{{ Lang::get('table_specific.kind') }}</th>
                    <th>{{ Lang::get('table_general.actions') }}</th>
                </tr>
                </thead>
                <tbody>

                {{-- LANGUAGE CHECK --}}
                @if (App::getLocale() == 'nl')

                    @foreach ($types as $type)
                    <tr class="type-row" id="type-row-{{ $type->game_type_id }}">
                        <td>
                            @if ($type->game_type_name_nl)
                            {{ $type->game_type_name_nl }}
                            @else
                            {{ '<span data-tooltip class="has-tip no-translation" title="Vertaling nodig" ><i class="fa fa-exclamation-triangle"></i>' . $type->game_type_name_en . '</span>' }}
                            @endif
                        </td>

                        <td>
                            @if ($type->game_kind->game_kind_name_nl)
                            {{ $type->game_kind->game_kind_name_nl }}
                            @else
                            {{ '<span data-tooltip class="has-tip no-translation" title="Vertaling nodig" ><i class="fa fa-exclamation-triangle"></i>' . $type->game_kind->game_kind_name_en . '</span>' }}
                            @endif
                        </td>

                        <td>
                            <a href="{{-- URL::route('admin.types.edit', [$type->game_type_id]) --}}">
                                <span data-tooltip class="has-tip" title="Edit type"><i class="fa fa-pencil"></i></span>
                            </a>

                            <a class="confirm" data-reveal-id="warning" href="{{ URL::route('admin.types.destroy', [$type->game_type_id]) }}" >
                                <span data-tooltip class="has-tip" title="Permadelete type"><i class="fa fa-trash-o"></i></span>
                            </a>

                        </td>
                    </tr>
                    @endforeach

                @else

                @foreach ($types as $type)
                <tr class="type-row" id="type-row-{{ $type->game_type_id }}">
                    <td>
                        @if ($type->game_type_name_en)
                        {{ $type->game_type_name_en }}
                        @else
                        {{ '<span data-tooltip class="has-tip no-translation" title="Needs translation" ><i class="fa fa-exclamation-triangle"></i>' . $type->game_type_name_nl . '</span>' }}
                        @endif
                    </td>

                    <td>
                        @if ($type->game_kind->game_kind_name_en)
                        {{ $type->game_kind->game_kind_name_en }}
                        @else
                        {{ '<span data-tooltip class="has-tip no-translation" title="Needs translation" ><i class="fa fa-exclamation-triangle"></i>' . $type->game_kind->game_kind_name_nl . '</span>' }}
                        @endif
                    </td>

                    <td>
                        <a href="{{-- URL::route('admin.types.edit', [$type->game_type_id]) --}}">
                            <span data-tooltip class="has-tip" title="Edit type"><i class="fa fa-pencil"></i></span>
                        </a>

                        <a class="confirm" data-reveal-id="warning" href="{{ URL::route('admin.types.destroy', [$type->game_type_id]) }}" >
                            <span data-tooltip class="has-tip" title="Permadelete type"><i class="fa fa-trash-o"></i></span>
                        </a>

                    </td>
                </tr>
                @endforeach

                @endif

                </tbody>
            </table>

            {{-- PAGER --}}
            <div class="pagination-centered">
                {{ $types->links() }}
            </div>

        </div>
    </div>
</div>


@stop