@extends('layouts.layout')
@section('page-title','404! Page not found.')
@section('content')


    <h2>Oops!</h2>
    <div class="panel panel-default">
        <div class="panel-heading">


            <h3>Page not found.</h3>


        </div>
        <div class="panel-body">
            <p>I think the page you are looking for must be invisible.</p>
        </div>
    </div>


@stop
@section('footer')
    @include("pages.footer")
@stop