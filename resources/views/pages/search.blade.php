@extends('layouts.layout')
@section('page-title','Search results')
@section('content')

    <div class="panel panel-default margin-top-20">
        <div class="panel-heading">

            <div class="panel-heading-custom">
                <h3>Search results for "{{$container['key']}}"</h3>
                <h3><a href="/flyers/create"> <i class="glyphicon glyphicon-plus-sign"></i> </a></h3>
            </div>
        </div>
        <div class="panel-body">
            @if(count($container['results'])>0)

                <ul class="list-group">
                    @foreach($container['results'] as $flyer)


                            <li class="list-group-item">
                        <span>
                        <a href="/flyers/{{$flyer['zip']}}/{{$flyer['street']}}">{{$flyer['street']}}, {{$flyer['city']}}
                            , {{$flyer['zip']}} {{$flyer['state']}}</a>
                            </span>
                                <span class="pull-right">{{$flyer['updated_at']}}</span>
                            </li>


                    @endforeach
                </ul>

            @else
                <span class="badge">No results found.</span>
            @endif

        </div>
    </div>

@stop
@section('footer')
    @include("pages.footer")
@stop