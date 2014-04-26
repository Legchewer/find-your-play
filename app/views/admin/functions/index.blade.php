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

<div class="content functions">
    <div class="row">
        <div class="large-12 columns content-header">

            <h1><i class="fa fa-lightbulb-o"></i> {{ Lang::get('admin-pages.function-categories') }} <small>{{ Lang::get('admin-pages.function-categories-sub') }}</small></h1>

        </div>
    </div>

    <?php // var_dump($functions[2]->game_function_category()); // can't go deeper? ?>

    <div class="row">
        <div class="large-12 columns content list">

            <table class="functions">
                <thead>
                <tr>
                    <th>{{ Lang::get('table_general.name') }}</th>
                    <th>{{ Lang::get('table_specific.category') }}</th>
                    <th>{{ Lang::get('table_general.actions') }}</th>
                </tr>
                </thead>
                <tbody>

                {{-- LANGUAGE CHECK --}}
                @if (App::getLocale() == 'nl')

                    @foreach ($functions as $function)
                    <tr class="function-row" id="funtion-row-{{ $function->function_id }}">
                        <td>
                            @if ($function->game_function_name_nl)
                            {{ $function->game_function_name_nl }}
                            @else
                            {{ '<span data-tooltip class="has-tip no-translation" title="Vertaling nodig" ><i class="fa fa-exclamation-triangle"></i>' . $function->game_function_name_en . '</span>' }}
                            @endif
                        </td>

                        <td>
                            @if ($function->game_function_category->game_function_category_name_nl)
                            {{ $function->game_function_category->game_function_category_name_nl }}
                            @else
                            {{ '<span data-tooltip class="has-tip no-translation" title="Vertaling nodig" ><i class="fa fa-exclamation-triangle"></i>' . $function->game_function_category->game_function_category_name_en . '</span>' }}
                            @endif
                        </td>

                        <td>
                            <a href="{{-- URL::route('admin.functions.edit', [$function->function_id]) --}}">
                                <span data-tooltip class="has-tip" title="Edit function"><i class="fa fa-pencil"></i></span>
                            </a>

                            <a class="confirm" data-reveal-id="warning" href="{{-- URL::route('admin.function.destroy', [$function->function_id]) --}}" >
                                <span data-tooltip class="has-tip" title="Permadelete function"><i class="fa fa-trash-o"></i></span>
                            </a>

                        </td>
                    </tr>
                    @endforeach

                @else

                @foreach ($functions as $function)
                <tr class="function-row" id="funtion-row-{{ $function->function_id }}">
                    <td>
                        @if ($function->game_function_name_en)
                        {{ $function->game_function_name_en }}
                        @else
                        {{ '<span data-tooltip class="has-tip no-translation" title="Vertaling nodig" ><i class="fa fa-exclamation-triangle"></i>' . $function->game_function_name_nl . '</span>' }}
                        @endif
                    </td>

                    <td>
                        @if ($function->game_function_category->game_function_category_name_en)
                        {{ $function->game_function_category->game_function_category_name_en }}
                        @else
                        {{ '<span data-tooltip class="has-tip no-translation" title="Vertaling nodig" ><i class="fa fa-exclamation-triangle"></i>' . $function->game_function_category->game_function_category_name_en . '</span>' }}
                        @endif
                    </td>

                    <td>
                        <a href="{{-- URL::route('admin.functions.edit', [$function->function_id]) --}}">
                            <span data-tooltip class="has-tip" title="Edit function"><i class="fa fa-pencil"></i></span>
                        </a>

                        <a class="confirm" data-reveal-id="warning" href="{{-- URL::route('admin.function.destroy', [$function->function_id]) --}}" >
                            <span data-tooltip class="has-tip" title="Permadelete function"><i class="fa fa-trash-o"></i></span>
                        </a>

                    </td>
                </tr>
                @endforeach

                @endif

                </tbody>
            </table>

            {{-- PAGER --}}
            <div class="pagination-centered">
                {{ $functions->links() }}
            </div>

        </div>
    </div>
</div>


@stop