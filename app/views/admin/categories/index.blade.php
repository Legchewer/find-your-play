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

<div class="content categories">
    <div class="row">
        <div class="large-12 columns content-header">

            <h1><i class="fa fa-book"></i> {{ Lang::choice('admin-pages.function-categories',1) }} <small>{{ Lang::get('admin-pages.function-categories-sub') }}</small></h1>

        </div>
    </div>

    <div class="row">
        <div class="large-12 columns content list">

            <table class="categories">
                <thead>
                <tr>
                    <th>{{ Lang::get('table_general.name') }}</th>
                    <th>{{ Lang::get('table_general.actions') }}</th>
                </tr>
                </thead>
                <tbody>

                {{-- LANGUAGE CHECK --}}
                @if (App::getLocale() == 'nl')

                    @foreach ($categories as $category)
                    <tr class="category-row" id="category-row-{{ $category->game_function_category_id }}">
                        <td>
                            @if ($category->game_function_category_name_nl)
                            {{ $category->game_function_category_name_nl }}
                            @else
                            {{ '<span data-tooltip class="has-tip no-translation" title="Vertaling nodig" ><i class="fa fa-exclamation-triangle"></i>' . $category->game_function_category_name_en . '</span>' }}
                            @endif
                        </td>

                        <td>
                            <a href="{{-- URL::route('admin.categories.edit', [$category->game_function_category_id]) --}}">
                                <span data-tooltip class="has-tip" title="Edit categorie"><i class="fa fa-pencil"></i></span>
                            </a>

                            <a class="confirm" data-reveal-id="warning" href="{{ URL::route('admin.categories.destroy', [$category->game_function_category_id]) }}" >
                                <span data-tooltip class="has-tip" title="Permadelete categorie"><i class="fa fa-trash-o"></i></span>
                            </a>

                        </td>
                    </tr>
                    @endforeach

                @else

                @foreach ($categories as $category)
                <tr class="category-row" id="category-row-{{ $category->game_function_category_id }}">
                    <td>
                        @if ($category->game_function_category_name_en)
                        {{ $category->game_function_category_name_en }}
                        @else
                        {{ '<span data-tooltip class="has-tip no-translation" title="Needs translation" ><i class="fa fa-exclamation-triangle"></i>' . $category->game_function_category_name_nl . '</span>' }}
                        @endif
                    </td>

                    <td>
                        <a href="{{-- URL::route('admin.categories.edit', [$category->game_function_category_id]) --}}">
                            <span data-tooltip class="has-tip" title="Edit category"><i class="fa fa-pencil"></i></span>
                        </a>

                        <a class="confirm" data-reveal-id="warning" href="{{ URL::route('admin.categories.destroy', [$category->game_function_category_id]) }}" >
                            <span data-tooltip class="has-tip" title="Permadelete category"><i class="fa fa-trash-o"></i></span>
                        </a>

                    </td>
                </tr>
                @endforeach

                @endif

                </tbody>
            </table>

            {{-- PAGER --}}
            <div class="pagination-centered">
                {{ $categories->links() }}
            </div>

        </div>
    </div>
</div>


@stop