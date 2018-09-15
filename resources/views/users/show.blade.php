@extends('layouts.app')

@section('content')

    <div class="col-md-9 col-sm-11 px-5 pl-md-2 pt-2 main mx-auto">
        <div class="card">
            <div class="card-header">{{$user->user_name}}</div>

            <div class="card-body">
                <img class="card-img-top" style="width:150px;" src="/storage/profile_images/{{$user->profile_image}}" alt="Profile image">
                <div>
                    {{$user->username}}
                    {{$user->dob}}<br>
                    {{$user->gender}}<br>
                    @if($user->address_id != null)
                        {{$user->line1}},
                        @if($user->line2 != "")
                            {{$user->line2}},
                        @endif
                        {{ $user->town_city}},
                        @if($user->county != "")
                            {{$user->county}},
                        @endif
                        {{$user->postcode}}<br>
                        @if($user->role == "support worker")
                            {{$user->dbs_num}}<br>
                        @endif
                    @endif
                    {{$user->email}}<br>
                    {{$user->role}}<br>

                </div>

                @if($user->role == "support worker")
                    <hr>
                    <p>{!! $user->contract_type !!}</p>
                    Availability<br>

                    Monday's - {{json_decode($user->availability)->Monday}}<br>
                    Tuesday's - {{json_decode($user->availability)->Tuesday}}<br>
                    Wednesday's - {{json_decode($user->availability)->Wednesday}}<br>
                    Thursday's - {{json_decode($user->availability)->Thursday}}<br>
                    Friday's - {{json_decode($user->availability)->Friday}}<br>
                    Saturday's - {{json_decode($user->availability)->Saturday}}<br>
                    Sunday's - {{json_decode($user->availability)->Sunday}}<br><br>


                    Specialises in
                    @foreach(json_decode($user->specialities) as $specialities )
                        <li>{{$specialities}}</li>
                    @endforeach
                @endif

                <small>Started on {{$user->created_at}}</small>
                <hr>
                <a href="/users/{{$user->id}}/edit" class="btn btn-default">Edit</a>
            </div>
            <div class="card-footer">

                <button type="button" class="btn btn-primary float-left" data-toggle="modal" data-target="#editSupportWorker">
                    Edit
                </button>

                {!!Form::open(['action' => ['UsersController@destroy', $user->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger float-right'])}}
                {!! Form::close() !!}
            </div>
        </div>
        <hr>
        <a href="/users" class="btn btn-primary">Go Back</a>
        </div>

    </div>

@endsection