@extends('layouts.app')

@section('content')
    <div class="col-md-9 col-sm-11 px-5 pl-md-2 pt-2 main mx-auto">

        <div class="card">
            <div class="card-header">Add New Refferal</div>

            <div class="card-body">
                {!! Form::open(['action' => 'SupportRequestsController@store', 'method' => 'POST']) !!}


                {{{Form::submit('Submit', ['class' => 'btn btn-primary'])}}}
                {!! Form::close() !!}
            </div>
        </div>
        <hr>
        <a href="/supportRequests" class="btn btn-primary">Go Back</a>
    </div>
@endsection