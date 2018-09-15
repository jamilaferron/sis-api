@extends('layouts.app')

@section('content')
    <div class="col-md-9 col-sm-11 px-5 pl-md-2 pt-2 main mx-auto">
        <div class="card">
            <div class="card-header">{{$serviceUser->su_name}}</div>

            <div class="card-body">
                <div>
                    {!! $serviceUser->needs !!}
                </div>
                <hr>
                <small>Referred on {{$serviceUser->created_at}}</small>
                <hr>

            </div>
            @if(Auth::user()->role == 'admin' || Auth::user()->role == 'manager')
            <div class="card-footer">
                    <a href="/serviceUsers/{{$serviceUser->id}}/edit" class="btn btn-default float-left">Edit</a>
                    {!!Form::open(['action' => ['ServiceUsersController@destroy', $serviceUser->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                    {{Form::hidden('_method', 'DELETE')}}
                    {{Form::submit('Delete', ['class' => 'btn btn-danger float-right'])}}
                    {!! Form::close() !!}
            </div>
            @endif
        </div>
        <hr>
        <div class="card">
            <div class="card-header">Upcoming Sessions</div>

            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-center">

                    @if(count($sessions) > 0)
                        @foreach ($sessions as $session)
                            @if($session->start_date >= \Carbon\Carbon::now())

                            <div class="card m-4" style=" width:270px">
                                <div class="card-body">
                                    <h4 class="card-title">{{$session->start_date}}</h4>
                                    <p class="card-text">Started {{$session->start_time}}</p>
                                    <p class="card-text">Started {{$session->end_time}}</p>
                                    <a href="/sessions/{{$session->id}}" class="btn btn-primary">View</a>
                                </div>
                            </div>
                            <br>
                            @endif

                        @endforeach
                </div>

                @else
                    <p>No Sessions found</p>
                @endif
            </div>
        </div>
        <hr>
        <div class="card">
            <div class="card-header">Past Sessions</div>

            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-center">

                    @if(count($sessions) > 0)
                        @foreach ($sessions as $session)
                            @if($session->start_date < \Carbon\Carbon::now() && $session->cancelled == false)

                                <div class="card m-4" style=" width:270px">
                                    <div class="card-body">
                                        <h4 class="card-title">{{$session->start_date}}</h4>
                                        <p class="card-text">Started {{$session->start_time}}</p>
                                        <p class="card-text">Started {{$session->end_time}}</p>
                                        <a href="/sessions/{{$session->id}}" class="btn btn-primary">View</a>
                                    </div>
                                </div>
                                <br>

                            @endif

                        @endforeach
                </div>

                @endif
            </div>
        </div>
        <hr>
        <div class="card">
            <div class="card-header">Cancelled Sessions</div>

            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-center">

                    @if(count($sessions) > 0)
                        @foreach ($sessions as $session)
                            @if($session->cancelled == true)

                                <div class="card m-4" style=" width:270px">
                                    <div class="card-body">
                                        <h4 class="card-title">{{$session->start_date}}</h4>
                                        <p class="card-text">Started {{$session->start_time}}</p>
                                        <p class="card-text">Started {{$session->end_time}}</p>
                                        <a href="/sessions/{{$session->id}}" class="btn btn-primary">View</a>
                                    </div>
                                </div>
                                <br>
                            @endif

                        @endforeach
                </div>

                @endif
            </div>
        </div>
        <hr>
        <a href="/serviceUsers" class="btn btn-primary">Go Back</a>
    </div>
@endsection