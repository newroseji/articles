@extends('layouts.layout')
@section('page-title','Create a new flyer')
@section('content')

    <div class="panel panel-default margin-top-20">
        <div class="panel-heading">

            <div class="panel-heading-custom">
                <h3>Published Articles</h3>

    <h3><a href="/articles/create"> <i class="glyphicon glyphicon-plus-sign"></i> Create an Article</a></h3>

</div>
</div>
<div class="panel-body">
@if(count($articles)>0)
    @foreach($articles as $article)
        <article>
            <h2>
                <a href="{{url('/articles',$article->id)}}">{{$article->title}}</a>
            </h2>
            <h5>Created by {{ $article->user->name }}</h5>
            <h6>published {{$article->published_at->diffForHumans()}}</h6>
            <hr/>
            <div class="body">
                {{str_limit($article->body,420)}}
                <br/>

                @if (strlen($article->body)>420)
                    <a href="{{url('/articles',$article->id)}}" class="btn btn-info margin-top-20">Read more
                        >></a>
                @endif
            </div>
        </article>
    @endforeach
    <div class="text-center">
        {!! $articles->appends(Request::except('page'))->render() !!}
    </div>

@else
    <span class="badge">No articles found.</span>
@endif
</div>
</div>



@stop


@section('footer')
@include("pages.footer")
@stop
