@extends('layouts.web.master')

@section('content')

<div class="large-12 columns">

    <h1>404 <small>De weg verloren?</small></h1>

    <p>Ga terug naar de {{ HTML::link('/', 'site', ['' => '']), PHP_EOL }}</p>

</div>

@stop