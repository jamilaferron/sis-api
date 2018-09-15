@extends('layouts.app')

@section('content')

    <div class="col-md-9 col-sm-11 px-5 pl-md-2 pt-2 main mx-auto">

        <div class="card">
            <div class="card-header">{{$supportWorkers->name}}</div>

            <div class="card-body">
                <div>
                   <p>{!! $supportWorkers->username !!}</p>
                    <p>{!! $supportWorkers->email !!}</p>
                    <p>{!! $supportWorkers->dbs_number !!}</p>
                    <p>{!! $supportWorkers->dob !!}</p>
                </div>
                <hr>
                <small>Started on {{$supportWorkers->created_at}}</small>
                <hr>
                @if(Auth::user()->role == 'admin')
                <a href="/supportWorkers/{{$supportWorkers->id}}/edit" class="btn btn-default">Edit</a>

                {!!Form::open(['action' => ['SupportWorkersController@destroy', $supportWorkers->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                {!! Form::close() !!}
                @endif
            </div>
        </div>
        <hr>
        <a href="/supportRequests" class="btn btn-primary">Go Back</a>
    </div>
@endsection