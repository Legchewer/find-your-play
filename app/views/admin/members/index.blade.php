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

<div class="content members">
    <div class="row">
        <div class="large-12 columns content-header">

            <h1><i class="fa fa-users"></i> {{ Lang::choice('admin-pages.members',1) }} <small>{{ Lang::get('admin-pages.members-sub') }}</small></h1>

        </div>
    </div>

    <div class="row">
        <div class="large-12 columns content list">

            <table class="members">
                <thead>
                <tr>
                    <th>{{ Lang::get('table_general.more-info') }}</th>
                    <th>{{ Lang::get('table_general.name') }}</th>
                    <th>{{ Lang::get('table_specific.email') }}</th>
                    <th>{{ Lang::get('table_specific.role') }}</th>
                    <th>{{ Lang::get('table_general.actions') }}</th>
                </tr>
                </thead>
                <tbody>

                {{-- LANGUAGE CHECK --}}
                @if (App::getLocale() == 'nl')

                @foreach ($members as $member)
                <tr class="member-row" id="member-row-{{ $member->member_id }}">

                    <td class="more-info">
                        <span data-tooltip class="has-tip tip-top" title="
                            {{ Lang::get('table_general.created') }}:
                            {{ $member->member_created }}
                            <br />
                            {{ Lang::get('table_general.modified') }}:
                            @if ($member->member_modified)
                                {{ $member->member_modified }}
                            @else
                                /
                            @endif
                            <br />
                            {{ Lang::get('table_general.deleted') }}:
                            @if ($member->member_deleted)
                                {{ $member->member_deleted }}
                            @else
                                /
                            @endif
                        "><i class="fa fa-info"></i></span>
                    </td>
                    <td>
                        {{ $member->person->person_givenname }} {{ $member->person->person_surname }}
                    </td>

                    <td>
                        {{ $member->person->person_email }}
                    </td>

                    <td>
                        {{ $member->role->role_name_nl }}
                    </td>

                    <td>
                        <a href="{{-- URL::route('admin.members.edit', [$member->member_id]) --}}">
                            <span data-tooltip class="has-tip" title="Edit lid"><i class="fa fa-pencil"></i></span>
                        </a>

                        <a class="confirm" data-reveal-id="warning" href="{{ URL::route('admin.members.destroy', [$member->member_id]) }}" >
                            <span data-tooltip class="has-tip" title="Permadelete lid"><i class="fa fa-trash-o"></i></span>
                        </a>

                    </td>
                </tr>
                @endforeach

                @else

                @foreach ($members as $member)
                <tr class="member-row" id="member-row-{{ $member->member_id }}">
                    <td class="more-info">
                        <span data-tooltip class="has-tip tip-top" title="
                            {{ Lang::get('table_general.created') }}:
                            {{ $member->member_created }}
                            <br />
                            {{ Lang::get('table_general.modified') }}:
                            @if ($member->member_modified)
                                {{ $member->member_modified }}
                            @else
                                /
                            @endif
                            <br />
                            {{ Lang::get('table_general.deleted') }}:
                            @if ($member->member_deleted)
                                {{ $member->member_deleted }}
                            @else
                                /
                            @endif
                        "><i class="fa fa-info"></i></span>
                    </td>
                    <td>
                        {{ $member->person->person_givenname }} {{ $member->person->person_surname }}
                    </td>

                    <td>
                        {{ $member->person->person_email }}
                    </td>

                    <td>
                        {{ $member->role->role_name_en }}
                    </td>

                    <td>
                        <a href="{{-- URL::route('admin.members.edit', [$member->member_id]) --}}">
                            <span data-tooltip class="has-tip" title="Edit member"><i class="fa fa-pencil"></i></span>
                        </a>

                        <a class="confirm" data-reveal-id="warning" href="{{ URL::route('admin.members.destroy', [$member->member_id]) }}" >
                            <span data-tooltip class="has-tip" title="Permadelete member"><i class="fa fa-trash-o"></i></span>
                        </a>

                    </td>
                </tr>
                @endforeach

                @endif

                </tbody>
            </table>

            {{-- PAGER --}}
            <div class="pagination-centered">
                {{ $members->links() }}
            </div>

        </div>
    </div>
</div>


@stop