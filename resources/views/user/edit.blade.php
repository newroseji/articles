@extends('debug.app')
@section('content')

    <div class="container col-md-10 col-md-offset-1">
        <h1>Update</h1>

        <form action="/user/update" method="POST">

            {!! csrf_field()!!}


            <div class="row">
                <!-- Name Form Input -->
                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }} col-md-4">
                    <label for="name">First Name:</label> <span class="required">*</span>
                    <input type="text" name="name" id="name" placeholder="First name" class="form-control"
                           value="{{$user->name}}">
                    @if ($errors->has('name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                    @endif
                </div>


            </div>




            <div class="row">
                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-primary btn-wide"><i class="glyphicon glyphicon-save"></i> Update</button>&nbsp;
                    <a href="{{ URL::previous() }}" class="text-danger" title="Cancel">cancel</a>
                </div>

            </div>

        </form>
    </div>
@stop
@section('footer')
    @include("pages.footer")
@stop