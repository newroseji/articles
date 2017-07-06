@extends('layouts.layout')
@section('page-title','Create a new article')
@section('content')
    <div class="row margin-top-20">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Update an Article</div>
                <div class="panel-body">

                    <form action="/articles/{{$articles->id}}" method="POST">
                        {{method_field('PATCH')}}
                        {!! csrf_field()!!}
                        <input type="hidden" name="id" value="{{$articles->id}}">
                        <!-- Title Form Input -->
                        <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">

                            <label for="title">Title:</label> <span class="required">*</span>

                            <div class="input-group col-md-12">

                                <input type="text" name="title" id="title" placeholder="Title" class="form-control"
                                       value="{{$articles->title}}">
                            </div>

                            @if ($errors->has('title'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <!-- Body Form Input -->
                        <div class="form-group {{ $errors->has('body') ? ' has-error' : '' }} ">
                            <label for="body">Body:</label> <span class="required">*</span>

                            <textarea name="body"
                                      placeholder="Type a brief body here..." rows="11"
                                      id="body" class="form-control col-md-12">{!! $articles->body !!}</textarea>
                            <script type="text/javascript">
                                CKEDITOR.replace('body');
                            </script>
                            @if ($errors->has('body'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <!-- Published At Form Input -->
                        <div class="form-group {{ $errors->has('published_at') ? ' has-error' : '' }} ">
                            <label for="published_at">Published On:</label> <span class="required">*</span>

                            <input type="text" name="published_at"
                                   placeholder="mm/dd/yyyy"
                                   id="published_at" class="form-control"
                                   value="{{$articles->published_at->format('m/d/Y')}}">
                            @if ($errors->has('published_at'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('published_at') }}</strong>
                                    </span>
                            @endif
                        </div>


                        <div class="col-md-12 margin-top-20 text-center text-muted">
                            <span class="caption">Asterisk(*) are required fields.</span>
                        </div>
                        <div class="col-md-12">

                            <div class="form-group margin-top-20">
                                <button type="submit" class="btn btn-primary"><i
                                            class="glyphicon glyphicon-save-file"></i>
                                    Update
                                </button>
                                <a href="{{ URL::previous() }}" class="btn btn-link" title="Cancel">cancel</a>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

@stop


@section('footer')
    @include("pages.footer")
@stop
