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

<div class="content roles">
    <div class="row">
        <div class="large-12 columns content-header">

            <h1><i class="fa fa-user"></i> {{ Lang::choice('admin-pages.roles',1) }} <small>{{ Lang::get('admin-pages.roles-sub') }}</small></h1>

        </div>
    </div>

    <div class="row">
        <div class="large-12 columns content list">

            <table class="roles">
                <thead>
                <tr>
                    <th>{{ Lang::get('table_general.name') }}</th>
                    <th>{{ Lang::get('table_general.actions') }}</th>
                </tr>
                </thead>
                <tbody>

                {{-- LANGUAGE CHECK --}}
                @if (App::getLocale() == 'nl')

                @foreach ($roles as $role)
                <tr class="role-row" id="role-row-{{ $role->role_id }}">
                    <td>
                        @if ($role->role_name_nl)
                        {{ $role->role_name_nl }}
                        @else
                        {{ '<span data-tooltip class="has-tip no-translation" title="Vertaling nodig" ><i class="fa fa-exclamation-triangle"></i>' . $role->role_name_en . '</span>' }}
                        @endif
                    </td>

                    <td>
                        <a href="{{-- URL::route('admin.roles.edit', [$role->role_id]) --}}">
                            <span data-tooltip class="has-tip" title="Edit rol"><i class="fa fa-pencil"></i></span>
                        </a>

                        <a class="confirm" data-reveal-id="warning" href="{{ URL::route('admin.roles.destroy', [$role->role_id]) }}" >
                            <span data-tooltip class="has-tip" title="Permadelete rol"><i class="fa fa-trash-o"></i></span>
                        </a>

                    </td>
                </tr>
                @endforeach

                @else

                @foreach ($roles as $role)
                <tr class="role-row" id="role-row-{{ $role->role_id }}">
                    <td>
                        @if ($role->role_name_en)
                        {{ $role->role_name_en }}
                        @else
                        {{ '<span data-tooltip class="has-tip no-translation" title="Needs translation" ><i class="fa fa-exclamation-triangle"></i>' . $role->role_name_nl . '</span>' }}
                        @endif
                    </td>

                    <td>
                        <a href="{{-- URL::route('admin.roles.edit', [$role->role_id]) --}}">
                            <span data-tooltip class="has-tip" title="Edit role"><i class="fa fa-pencil"></i></span>
                        </a>

                        <a class="confirm" data-reveal-id="warning" href="{{ URL::route('admin.roles.destroy', [$role->role_id]) }}" >
                            <span data-tooltip class="has-tip" title="Permadelete role"><i class="fa fa-trash-o"></i></span>
                        </a>

                    </td>
                </tr>
                @endforeach

                @endif

                </tbody>
            </table>

            {{-- PAGER --}}
            <div class="pagination-centered">
                {{ $roles->links() }}
            </div>

            <a href="{{ URL::route('admin.roles.create') }}" class="button button-add"><i class="fa fa-plus"></i>{{ Lang::choice('table_general.add', 0, ['type' => strtolower(Lang::choice('admin-pages.roles',0))]) }}</a>

        </div>
    </div>
</div>


@stop