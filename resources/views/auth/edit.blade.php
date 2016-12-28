@extends('layout.app')

@section('content')
    {!! Form::model($users, ['method' => 'POST', 'url' => ['auth/admin/update'], $users['id']]) !!}

    {{ csrf_field() }}
    {{ Form::hidden('id', $users->id ) }}

    <div class="form-group">
        {{ Form::label('name') }}
        {{ Form::text('name', null, array('class' => 'form-control', )) }}
    </div>

    <div class="form-group">
        {{ Form::label('email') }}
        {{ Form::text('email', null, array('class' => 'form-control', )) }}
    </div>

    {{ Form::select('law', array('quest' => 'quest', 'moder' => 'moderator', 'admin' => 'admin')) }}

    <div class="form-group">
        {{ Form::label('password') }}
        {{ Form::password('password', array('class' => 'form-control', )) }}
    </div>

    {{ Form::submit('Update',  array('class' => 'btn btn-primary btn-lg btn-block')) }}

    {!! Form::close() !!}


@endsection