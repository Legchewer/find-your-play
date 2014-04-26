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

<div class="content budgetgroups">
    <div class="row">
        <div class="large-12 columns content-header">

            <h1><i class="fa fa-money"></i> {{ Lang::get('admin-pages.budget-groups') }} <small>{{ Lang::get('admin-pages.budget-groups-sub') }}</small></h1>

        </div>
    </div>

    <div class="row">
        <div class="large-12 columns content list">

            <table class="budgetgroups">
                <thead>
                <tr>
                    <th>{{ Lang::get('table_general.value') }}</th>
                    <th>{{ Lang::get('table_general.actions') }}</th>
                </tr>
                </thead>
                <tbody>

                    @foreach ($budgetgroups as $budgetgroup)
                    <tr class="budgetgroup-row" id="budgetgroup-row-{{ $budgetgroup->budget_group_id }}">
                        <td>
                            @if ($budgetgroup->budget_group_value)
                            {{ $budgetgroup->budget_group_value }}
                            @endif
                        </td>

                        <td>
                            <a href="{{-- URL::route('admin.budgetgroups.edit', [$budgetgroup->budget_group_id]) --}}">
                                <span data-tooltip class="has-tip" title="Edit budgetgroep"><i class="fa fa-pencil"></i></span>
                            </a>

                            <a class="confirm" data-reveal-id="warning" href="{{-- URL::route('admin.budgetgroups.destroy', [$budgetgroup->budget_group_id]) --}}" >
                                <span data-tooltip class="has-tip" title="Permadelete budgetgroep"><i class="fa fa-trash-o"></i></span>
                            </a>

                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>

            {{-- PAGER --}}
            <div class="pagination-centered">
                {{ $budgetgroups->links() }}
            </div>

        </div>
    </div>
</div>


@stop