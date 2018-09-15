@extends('layouts.app')

@section('content')
    <div class="col-md-9 col-sm-11 px-5 pl-md-2 pt-2 main mx-auto">

        <div class="card">
            <div class="card-header">Edit Service User</div>

            <div class="card-body">
                {!! Form::open(['action' => ['ServiceUsersController@update', $serviceUser->id], 'method' => 'POST']) !!}
                <div class="form-group">
                    {{Form::label('firstname', 'First Name')}}
                    {{Form::text('firstname', $serviceUser->firstname, ['class' => 'form-control', 'placeholder' => 'First Name'])}}
                </div>
                <div class="form-group">
                    {{Form::label('lastname', 'Last Name')}}
                    {{Form::text('lastname', $serviceUser->lastname, ['class' => 'form-control', 'placeholder' => 'Last Name'])}}
                </div>
                <div class="form-group">
                    {{Form::label('dob', 'D.O.B')}}
                    {{Form::date('dob', $serviceUser->dob, ['class' => 'form-control', 'placeholder' => 'D.O.B'])}}
                </div>
                <div class="form-group">
                    {{Form::label('needs', 'Needs')}}
                    {{Form::text('needs', $serviceUser->needs, ['class' => 'form-control', 'placeholder' => 'Needs'])}}
                </div>
                <div class="form-group">
                    {{Form::label('local_authority', 'Local Authority')}}
                    {{Form::text('local_authority', $serviceUser->local_authority, ['class' => 'form-control', 'placeholder' => 'Local Authority'])}}
                </div>
                {{Form::hidden('_method', 'PUT')}}
                {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                {!! Form::close() !!}
            </div>
        </div>
        <hr>

    </div>
@endsection
