@extends('layout.app')

@section('content')

    <h1 class="text-center">admin panel</h1>

    <table border="1">
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->law }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    {!! Form::open(['url' => 'auth/admin/'.$user->id.'/edit']) !!}
                        {{ Form::hidden('id', $user->id ) }}
                        {{ Form::submit('Edit',  array('class' => 'btn btn-lg btn-block')) }}
                    {!! Form::close() !!}
                </td>
                <td>
                    {!! Form::open(['url' => 'auth/admin/delete']) !!}
                        {{ Form::hidden('id', $user->id ) }}
                        {{ Form::submit('Delete',  array('class' => 'btn btn-lg btn-block')) }}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </table>




@endsection