@extends('layouts.admin.master')

@section('content')

{{-- modal window --}}
<div id="warning" class="reveal-modal" data-reveal>
    <h2>{{ Lang::get('modal.warning') }}</h2>
    <p class="lead">{{ Lang::get('modal.lead1') }}</p>
    <p>{{ Lang::get('modal.lead2') }}</p>
    <a id="warning-accept" class="button symptoms" href="#">{{ Lang::get('modal.continue') }}</a>
    <a class="button symptoms" href="">{{ Lang::get('modal.cancel') }}</a>
    <a class="close-reveal-modal">&#215;</a>
</div>

<div class="content themes">
    <div class="row">
        <div class="large-12 columns content-header">

            <h1><i class="fa fa-rocket"></i> {{ Lang::get('admin-pages.themes') }} <small>{{ Lang::get('admin-pages.themes-sub') }}</small></h1>

        </div>
    </div>
</div>


@stop