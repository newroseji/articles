@extends('debug.app')
@section('page-title','User Profile')
@section('content')
    <br/>
    <div class="container col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">

                <div class="panel-heading-custom">
                    <h3>User profile</h3>
                </div>
            </div>
            <div class="panel-body">

                <div class="row">
                    <!-- Name Form Input -->
                    <div class="form-group col-md-4">
                        <label for="name">Name:</label>
                        <span class="form-control">{{$user->name}}</span>
                    </div>

                </div>
                <div class="row">

                    <!-- Email Form Input -->
                    <div class="form-group col-md-4">
                        <label for="email">Email:</label>


                        <span class="form-control">{{$user->email}}</span>


                    </div>
                </div>

            </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="form-group col-md-12">
                        <a href="/user/edit" class="btn btn-primary btn-wide"><i
                                    class="glyphicon glyphicon-pencil"></i> Edit</a>&nbsp;

                    </div>
                </div>
            </div>
        </div>
        <hr>

        <div class="panel panel-default">
            <form action="/user/pw" method="POST">
                <div class="panel-heading">

                    <div class="panel-heading-custom">
                        <h3>Change password</h3>
                    </div>
                </div>
                <div class="panel-body">


                    {!! csrf_field()!!}
                    <input type="hidden" name="id" value="{{$user->id}}">

                    <div class="row">
                        <!-- Old Password Form Input -->
                        <div class="form-group {{ $errors->has('old_password') ? ' has-error' : '' }} col-md-4">
                            <label for="old_password">Old Password:</label> <span class="required">*</span>
                            <input type="password" name="old_password" id="old_password" placeholder="Old Password"
                                   class="form-control"
                                   value="{{old('old_password')}}">
                            @if ($errors->has('old_password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('old_password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <!-- Password Form Input -->
                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }} col-md-4">
                            <label for="password">New Password:</label> <span class="required">*</span>
                            <input type="password" name="password" id="password" placeholder="New Password"
                                   class="form-control"
                                   value="{{old('password')}}">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <!-- Confirm password Form Input -->
                        <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }} col-md-4">
                            <label for="password_confirmation">Confirm password:</label> <span class="required">*</span>
                            <input type="password" name="password_confirmation" placeholder="Password confirmation"
                                   id="password_confirmation" class="form-control"
                                   value="{{old('password_confirmation')}}">
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="panel-footer">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-wide"><i
                                    class="glyphicon glyphicon-save"></i> Update
                        </button>
                        &nbsp;

                    </div>
                </div>

            </form>
        </div>

    </div>









@stop
@section('footer')
    @include("pages.footer")
@stop