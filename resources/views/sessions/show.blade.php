@extends('layouts.app')

@section('content')
    <div class="col-md-9 col-sm-11 px-5 pl-md-2 pt-2 main mx-auto">
        <div class="card">
            <div class="card-header">{{$session->session_type}}</div>

            <div class="card-body">
                <div>
                    {{$session->session_type}}
                </div>
                <hr>
                {{$supportworker->user_id}}

            </div>
            @if(Auth::user()->id == $supportworker->user_id)
            <div class="card-footer">
                <form method="POST" action="{{action('SessionsController@update', $session->id)}}" class="float-left">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="time" value="startTime">
                    <input type="submit" value="Start Session" class="btn btn-success">
                </form>

                <form method="POST" action="{{action('SessionsController@update', $session->id)}}" class="float-right">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="time" value="endTime">
                    <input type="submit" value="End Session" class="btn btn-success">
                </form>



            </div>
            @endif

        </div>
        <hr>
        <div>
            @if($session->report_id == null)
                    {!! Form::open(['action' => ['SessionsController@update', $session->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

                    <div class="form-group">
                        {{Form::file('cover_image')}}
                        {{ Form::hidden('image', 'secret') }}
                    </div>
                {{Form::hidden('_method', 'PUT')}}
                {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                {!! Form::close() !!}
            @endif
        </div>
        <hr>

        <a href="/serviceUsers/{{$session->serviceuser_id}}" class="btn btn-primary">Go Back</a>
    </div>
@endsection
@section('scripts')

@endsection