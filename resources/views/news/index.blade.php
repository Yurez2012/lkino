@extends('layout.app')

@section('content')
    <h1>Index php</h1>
    @if(isset($user['user']) and isset($user['law']))
        <h2>Привіт: {{ $user['user'] }}</h2>
        <h2>Status: {{ $user['law'] }}</h2>

        {!! Form::open(['url' => 'auth/logout']) !!}
             {{ Form::submit('Вийти',  array('class' => 'btn btn-primary btn-lg btn-block')) }}
        {!! Form::close() !!}

    @endif

    @if(!isset($user['user']) and !isset($user['law']))

        {{ link_to('auth/user', $title = 'Войти') }}
    @endif
@endsection