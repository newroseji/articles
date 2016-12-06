@extends('layouts.layout')
@section('page-title','Create a new article')
@section("styles")
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.css" rel="stylesheet">
@stop
@section('content')
    <div class="row margin-top-20">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>{{$articles->title}}</h2>
                    <h5>Created by {{ $articles->user->name }}</h5>
                    <h5>
                        @if ($articles->published_at>\Carbon\Carbon::now())
                            Will publish
                        @else
                            Published
                        @endif
                        {{$articles->published_at->diffForHumans()}}</h5>
                    <span style="display:flex">
                    @if( !Auth::guest() && Auth::user()->id == $articles->user_id)
                            <a href="{{url('/articles',$articles->id)}}/edit" title="Edit"><i
                                        class="glyphicon glyphicon-edit"></i></a>
                            <form method="POST" action="{{url('/articles',$articles->id)}}">
                        {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" style="background:none;border:none;color:indianred"
                                        title="Delete this article"><i class="glyphicon glyphicon-trash"></i></button>
                    </form>

                        @endif
                    </span>
                </div>
            </div>
            <div class="panel-body">

                <article>
                    <div class="body">
                        {!! $articles->body!!}
                    </div>

                </article>


                <div class="row">
                    <div class="col-md-12 photo-locker margin-top-20" id="flyer-photos">
                        @foreach($articles->photos->chunk(4) as $set)


                            @foreach($set as $photo)
                                <div class="col-md-3 col-sm-4 photo-locker-photo">
                                    @if ( Auth::user() && Auth::user()->owns($articles))
                                        {!! link_to('Delete',"/photos/{$photo->id}",'DELETE',"col-md-3 col-sm-3 delFrm") !!}
                                    @endif

                                    <a href="/{{$photo->photo_path}}" data-lity>
                                        <img src="/{{$photo->thumbnail_path}}" alt="{{$photo->caption}}"/>
                                    </a>

                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>


                @if ( !Auth::guest() && Auth::user()->id == $articles->user_id )
                    <div class="row">
                        <form id="addPhotosForm"
                              action="{{ route('store_photo_path',[$articles->id]) }}"
                              class="dropzone">
                            {!! csrf_field() !!}
                        </form>
                    </div>

                @endif

            </div>
        </div>
    </div>
    </div>
@stop


@section('footer')
    @include("pages.footer")
@stop

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.js"></script>
    <script>
        Dropzone.options.addPhotosForm = {
            paramName: 'photo',
            maxFilesize: 10,
            acceptedFiles: '.jpg,.jpeg,.png,.bmp'
        }
    </script>

@stop