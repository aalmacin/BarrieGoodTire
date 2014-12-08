@extends('layout')
@section('title')
Administrator Login
@stop
@section('content')
  {{ Form::open(array('url' => 'login')) }}
    <h1>Login</h1>
    <p>
      {{ $errors->first('email') }}
      {{ $errors->first('password') }}
    </p>

    <div class="username">
      <p>
        {{ Form::label('username', 'Username: ') }}
        {{ Form::text('username') }}
      </p>
    </div>
    <div class="password">
      <p>
        {{ Form::label('password', 'Password: ') }}
        {{ Form::password('password') }}
      </p>
    </div>
    {{ Form::token() }}
    <div class="submit">
      <p>
        {{ Form::submit('Login') }}
      </p>
    </div>
  {{ Form::close() }}
@stop
