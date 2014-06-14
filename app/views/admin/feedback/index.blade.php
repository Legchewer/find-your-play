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

<div class="content feedback">
    <div class="row">
        <div class="large-12 columns content-header">

            <h1><i class="fa fa-comments"></i> {{ Lang::choice('admin-pages.feedback',1) }} <small>{{ Lang::get('admin-pages.feedback-sub') }}</small></h1>

        </div>
    </div>

    <div class="row">
        <div class="large-12 columns content list">

            <ul class="feedback-list"> <!-- two columns? -->

                {{-- LANGUAGE CHECK --}}
                @if (App::getLocale() == 'nl')

                @foreach ($games as $game)

                    @if (!$game->feedback->isEmpty())

                    <li>
                        <article class="feedback-game row">
                            <header class="large-12 columns feedback-game-header">
                                <h2>{{ $game->game_title_nl }} &nbsp; | &nbsp;
                                    @if ($game->feedback->count() == 1)
                                        {{ $game->feedback->count() }} bericht
                                    @else
                                        {{ $game->feedback->count() }} berichten
                                    @endif
                                </h2>
                            </header>
                            <div class="feedback-game-info">

                                <div class="large-6 medium-4 columns feedback-game-img">

                                    @if($game->game_image)

                                        {{ HTML::image('uploads/images/' . $game->game_image, 'alt text', ['class' => '']) }}
                                    @else
                                        <p>NO IMG</p> <!-- NEEDS DEFAULT IMAGE? -->
                                    @endif

                                </div>

                                <div class="large-6 medium-8 columns feedback-game-info-list">
                                    <ul>
                                        <li>type: {{ $game->game_type->game_type_name_nl }}</li>
                                        <li>thema: {{ $game->theme->theme_name_nl }}</li>
                                    </ul>
                                </div>

                            </div>
                            <footer class="feedback-game-messages">

                                <ul>

                                @foreach ($game->feedback as $feedback)

                                    <li>
                                        <h3>
                                            door {{ $feedback->member->person->person_givenname }} {{ $feedback->member->person->person_surname }}
                                            <a class="confirm" data-reveal-id="warning" href="{{ URL::route('admin.feedback.destroy', [$feedback->feedback_id]) }}" >
                                                <span data-tooltip data-options="disable_for_touch:true" class="has-tip" title="Delete feedback"><i class="fa fa-trash-o"></i></span>
                                            </a>
                                        </h3>
                                        <div class="feedback-text">
                                            <p>{{ $feedback->feedback_text }}</p>
                                        </div>
                                    </li>

                                @endforeach

                                </ul>

                                <span class="show-feedback-btn">Toon/verberg berichten</span>

                            </footer>
                        </article>
                    </li>

                    @endif

                @endforeach

                @else

                @endif

            </ul>

            {{-- PAGER --}}
            <div class="pagination-centered">
                {{ $games->links() }}
            </div>

        </div>
    </div>
</div>

@stop

@section('userScripts')

{{ HTML::script("js/admin/admin-feedback.js") }}

@stop