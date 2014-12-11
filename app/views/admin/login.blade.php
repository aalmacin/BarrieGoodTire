@extends('admin.layout')
@section('title')
Administrator Login
@stop
@section('content')
  {{ Form::open(array('url' => 'login', 'role' => 'form', 'class' => 'form-horizontal')) }}
    <div class="col-sm-offset-2 col-sm-10">
      <h1>Login</h1>
    </div>
    
    @include('includes.general.errors', array('errors' => $errors))

    <div class="form-group">
      {{ Form::label('username', 'Username: ', array('class'=>'col-sm-2 control-label')) }}
      <div class="col-sm-8">
        {{ Form::text('username', null, array('class'=>'form-control')) }}
      </div>
    </div>
    <div class="form-group">
      {{ Form::label('password', 'Password: ', array('class'=>'col-sm-2 control-label')) }}
      <div class="col-sm-8">
        {{ Form::password('password', array('class'=>'form-control')) }}
      </div>
    </div>
    {{ Form::token() }}
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        {{ Form::submit('Login', array('class'=>'btn btn-default')) }}
      </div>
    </div>
  {{ Form::close() }}
@stop
