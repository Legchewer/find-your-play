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

<div class="content themes">
    <div class="row">
        <div class="large-12 columns content-header">

            <h1><i class="fa fa-rocket"></i> {{ Lang::choice('admin-pages.themes',1) }} <small>{{ Lang::get('admin-pages.themes-sub') }}</small></h1>

            <span class="count">{{ $count }}</span>

        </div>
    </div>

    <div class="row">
        <div class="large-12 columns content list">

            <table class="themes">
                <thead>
                <tr>
                    <th>{{ Lang::get('table_general.name') }}</th>
                    <th>{{ Lang::get('table_general.actions') }}</th>
                </tr>
                </thead>
                <tbody>

                {{-- LANGUAGE CHECK --}}
                @if (App::getLocale() == 'nl')

                    @foreach ($themes as $theme)
                    <tr class="theme-row" id="theme-row-{{ $theme->theme_id }}">
                        <td>
                            @if ($theme->theme_name_nl)
                            {{ $theme->theme_name_nl }}
                            @else
                            {{ '<span data-tooltip class="has-tip no-translation" title="Vertaling nodig" ><i class="fa fa-exclamation-triangle"></i>' . $theme->theme_name_en . '</span>' }}
                            @endif
                        </td>

                        <td>
                            <a href="{{ URL::route('admin.themes.edit', [$theme->theme_id]) }}">
                                <span data-tooltip data-options="disable_for_touch:true" class="has-tip" title="Edit thema"><i class="fa fa-pencil"></i></span>
                            </a>

                            <a class="confirm" data-reveal-id="warning" href="{{ URL::route('admin.themes.destroy', [$theme->theme_id]) }}" >
                                <span data-tooltip data-options="disable_for_touch:true" class="has-tip" title="Permadelete thema"><i class="fa fa-trash-o"></i></span>
                            </a>

                        </td>
                    </tr>
                    @endforeach

                @else

                    @foreach ($themes as $theme)
                    <tr class="theme-row" id="theme-row-{{ $theme->theme_id }}">
                        <td>
                            @if ($theme->theme_name_en)
                            {{ $theme->theme_name_en }}
                            @else
                            {{ '<span data-tooltip class="has-tip no-translation" title="Needs translation" ><i class="fa fa-exclamation-triangle"></i>' . $theme->theme_name_nl . '</span>' }}
                            @endif
                        </td>

                        <td>
                            <a href="{{ URL::route('admin.themes.edit', [$theme->theme_id]) }}">
                                <span data-tooltip data-options="disable_for_touch:true" class="has-tip" title="Edit theme"><i class="fa fa-pencil"></i></span>
                            </a>

                            <a class="confirm" data-reveal-id="warning" href="{{ URL::route('admin.themes.destroy', [$theme->theme_id]) }}" >
                                <span data-tooltip data-options="disable_for_touch:true" class="has-tip" title="Permadelete thema"><i class="fa fa-trash-o"></i></span>
                            </a>

                        </td>
                    </tr>
                    @endforeach

                @endif

                </tbody>
            </table>

            {{-- PAGER --}}
            <div class="pagination-centered">
                {{ $themes->links() }}
            </div>

            <a href="{{ URL::route('admin.themes.create') }}" class="button button-add"><i class="fa fa-plus"></i>{{ Lang::choice('table_general.add', 1, ['type' => strtolower(Lang::choice('admin-pages.themes',0))]) }}</a>

        </div>
    </div>
</div>


@stop