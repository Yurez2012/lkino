@extends('layout.app')

@section('content')
    {!! Form::open(['url' => '/auth']) !!}

    <div class="form-group">
        {{ Form::label('name') }}
        {{ Form::text('name', null, array('class' => 'form-control', )) }}
    </div>

    <div class="form-group">
        {{ Form::label('password') }}
        {{ Form::password('password', array('class' => 'form-control', )) }}
    </div>

    {{ Form::submit('Вхід',  array('class' => 'btn btn-primary btn-lg btn-block')) }}

    {!! Form::close() !!}

    <div class="container">
        @if($errors->any())
            <ul class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

@endsection