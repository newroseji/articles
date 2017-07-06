@extends('layouts.layout')
@section('page-title','Search results')
@section('content')

    <div class="panel panel-default margin-top-20">
        <div class="panel-heading">

            <div class="panel-heading-custom">
                <h3>Search results for "{{$container['text']}}"</h3>

            </div>
        </div>
        <div class="panel-body">
            @if(count($container['results'])>0)

                <ul class="list-group">
                    @foreach($container['results'] as $result)

                        <li class = "list-group-item">
                            <h3>
                                <a href = "/articles/{{$result->id}}"> {!! \App\Article::highlightWords($result->title,$container['text'])!!}</a>
                            </h3>
                            <p>
                                {!! \App\Article::highlightWords($result->body,$container['text'])!!}
                            </p>
                        </li>
                    @endforeach
                </ul>
                <div class = "text-center">
                    {!! $container['results']->appends(Request::except('page'))->render() !!}
                </div>
            @else
                <span class="badge">No results found</span>
            @endif

        </div>
    </div>

@stop
@section('footer')
    @include("pages.footer")
@stop