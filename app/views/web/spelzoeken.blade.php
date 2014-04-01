@extends('layouts.web.master')

@section('content')
<div class="row">
    <div class="small-12 columns">
        <ul class="breadcrumbs">
            <li><a href="{{ url('/')}}">Home</a></li>
            <li class="current">Spellen zoeken</li>
        </ul>
    </div>
</div>
<div class="row">
        <div class="medium-3 columns">
            <form>
                    <label>Select Box
                        <select>
                            <option value="husker">Husker</option>
                            <option value="starbuck">Starbuck</option>
                            <option value="hotdog">Hot Dog</option>
                            <option value="apollo">Apollo</option>
                        </select>
                    </label>
                    <label>Select Box
                        <select>
                            <option value="husker">Husker</option>
                            <option value="starbuck">Starbuck</option>
                            <option value="hotdog">Hot Dog</option>
                            <option value="apollo">Apollo</option>
                        </select>
                    </label>
                    <label>Select Box
                        <select>
                            <option value="husker">Husker</option>
                            <option value="starbuck">Starbuck</option>
                            <option value="hotdog">Hot Dog</option>
                            <option value="apollo">Apollo</option>
                        </select>
                    </label>
                    <label>Select Box
                        <select>
                            <option value="husker">Husker</option>
                            <option value="starbuck">Starbuck</option>
                            <option value="hotdog">Hot Dog</option>
                            <option value="apollo">Apollo</option>
                        </select>
                    </label>
            </form>
        </div>
        <div class="medium-9 columns">
            <ul class="medium-block-grid-3 small-block-grid-2">
                <li><a class="th" href="{{ url('/game')}}">
                        <img src="http://lorempixel.com/280/200">
                    </a></li>
                <li><a class="th" href="{{ url('/game')}}">
                        <img src="http://lorempixel.com/280/200">
                    </a></li>
                <li><a class="th" href="{{ url('/game')}}">
                        <img src="http://lorempixel.com/280/200">
                    </a></li>
            </ul>
            <ul class="medium-block-grid-3 small-block-grid-2">
                <li><a class="th" href="{{ url('/game')}}">
                        <img src="http://lorempixel.com/280/200">
                    </a></li>
                <li><a class="th" href="{{ url('/game')}}">
                        <img src="http://lorempixel.com/280/200">
                    </a></li>
                <li><a class="th" href="{{ url('/game')}}">
                        <img src="http://lorempixel.com/280/200">
                    </a></li>
            </ul>
            <ul class="medium-block-grid-3 small-block-grid-2">
                <li><a class="th" href="{{ url('/game')}}">
                        <img src="http://lorempixel.com/280/200">
                    </a></li>
                <li><a class="th" href="{{ url('/game')}}">
                        <img src="http://lorempixel.com/280/200">
                    </a></li>
                <li><a class="th" href="{{ url('/game')}}">
                        <img src="http://lorempixel.com/280/200">
                    </a></li>
            </ul>
    </div>
</div>
@stop