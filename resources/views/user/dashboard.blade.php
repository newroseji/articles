@extends('debug.app')
@section('page-title','User Dashboard')
@section('content')
    <h2>Dashboard</h2>

    <div class="panel panel-default">
        <div class="panel-heading">

            <div class="panel-heading-custom">
                <h3>My Articles</h3>
                <h3><a href="/articles/create"> <i class="glyphicon glyphicon-plus-sign"></i> </a></h3>
            </div>
        </div>
        <div class="panel-body">

            @if(count($articles)>0)


                <div class="row bg-info">

                    <div class="col-md-9 col-sm-7 col-xs-7">
                        Title
                    </div>
                    <div class="col-md-2 col-sm-3 hidden-xs">
                        Published
                    </div>
                    <div class="col-md-1 col-sm-2 col-xs-5">
                        <span class="pull-right">Actions</span>
                    </div>
                </div>
                @foreach($articles as $article)

                    <div class="row">


                        <div class="col-md-9 col-sm-7 col-xs-7">
                            <a href="/articles/{{$article->id}}"
                               title="{{str_limit($article->body,25,'...')}}"

                            >{{$article->title}}
                            </a>
                        </div>

                        <div class="col-md-2 col-sm-3 hidden-xs">
<span class="badge badge-info">
                            {{$article->published_at->diffForHumans()}}
                            </span>
                        </div>

                        <div class="col-md-1 col-sm-2 col-xs-5">

                            <span class="pull-right" style="display:flex">
                                <a href="/articles/{{$article->id}}/edit" title="Edit {{$article->title}}"><i
                                            class="glyphicon glyphicon-pencil"></i></a>
                                &nbsp;
                                <form method="POST" action="{{url('/articles',$article->id)}}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" title="Delete {{$article->title}}"
                                            class="bg-danger" style="border:none;background: none;color:indianred"><i class="glyphicon glyphicon-trash"></i></button>
                                </form>

                            </span>

                        </div>
                    </div>
                @endforeach

                <div class="text-center">
                    {!! $articles->appends(Request::except('page'))->render() !!}
                </div>
            @else
                <span class="badge badge-warning">No articles found.</span>
            @endif
        </div>
    </div>
@stop
@section('footer')
    @include("pages.footer")
@stop