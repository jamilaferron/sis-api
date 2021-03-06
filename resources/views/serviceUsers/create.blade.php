@extends('layouts.app')

@section('content')
    <div class="col-md-9 col-sm-11 px-5 pl-md-2 pt-2 main mx-auto">

        <div class="card">
            <div class="card-header">Add Service</div>

            <div class="card-body">
                {!! Form::open(['action' => 'ServiceUsersController@store', 'method' => 'POST']) !!}
                <fieldset>
                    <legend>Details:</legend>
                <div class="form-group">
                    {{Form::label('suname', 'Name')}}
                    {{Form::text('suname', '', ['class' => 'form-control', 'placeholder' => 'Name'])}}
                </div>
                <div class="form-group">
                    {{Form::label('dob', 'D.O.B')}}
                    {{Form::date('dob', '', ['class' => 'form-control', 'placeholder' => 'D.O.B'])}}
                </div>
                <div class="form-group">
                    {{Form::label('needs', 'Needs')}}
                    {{Form::text('needs', '', ['class' => 'form-control', 'placeholder' => 'Needs'])}}
                </div>
                    <div class="form-group">
                        {{Form::label('background', 'Background Info')}}
                        {{Form::textarea('background', '', ['class' => 'form-control', 'placeholder' => 'Background Information'])}}
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Address:</legend>
                    <div class="form-group">
                        {{Form::label('suline1', 'Line 1')}}
                        {{Form::text('suline1', '', ['class' => 'form-control', 'placeholder' => 'Line 1'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('suline2', 'Line 2')}}
                        {{Form::text('suline2', '', ['class' => 'form-control', 'placeholder' => 'Line 2'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('sutown', 'Town')}}
                        {{Form::text('sutown', '', ['class' => 'form-control', 'placeholder' => 'Town'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('sucounty', 'County')}}
                        {{Form::text('sucounty', '', ['class' => 'form-control', 'placeholder' => 'County'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('supostal_code', 'Post Code')}}
                        {{Form::text('supostal_code', '', ['class' => 'form-control', 'placeholder' => 'Post Code'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('suaddress_type', 'Address Type')}}
                        {!! Form::select('suaddress_type', array('Work' => 'Work', 'Home' => 'Home', 'School' => 'School', 'Contact' => 'Contact')) !!}

                    </div>
                </fieldset>
                <fieldset>
                    <legend>Social Worker Details:</legend>
                    <div class="form-group">
                        {{Form::label('swname', 'Name')}}
                        {{Form::text('swname', '', ['class' => 'form-control', 'placeholder' => 'Name'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('team', 'Team')}}
                        {{Form::text('team', '', ['class' => 'form-control', 'placeholder' => 'Team'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('email', 'Email')}}
                        {{Form::text('email', '', ['class' => 'form-control', 'placeholder' => 'Email'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('local_authority', 'Local Authority')}}
                        {{Form::text('local_authority', '', ['class' => 'form-control', 'placeholder' => 'Local Authority'])}}
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Address:</legend>
                    <div class="form-group">
                        {{Form::label('swline1', 'Line 1')}}
                        {{Form::text('swline1', '', ['class' => 'form-control', 'placeholder' => 'Line 1'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('swline2', 'Line 2')}}
                        {{Form::text('swline2', '', ['class' => 'form-control', 'placeholder' => 'Line 2'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('swtown', 'Town')}}
                        {{Form::text('swtown', '', ['class' => 'form-control', 'placeholder' => 'Town'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('swcounty', 'County')}}
                        {{Form::text('swcounty', '', ['class' => 'form-control', 'placeholder' => 'County'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('swpostal_code', 'Post Code')}}
                        {{Form::text('swpostal_code', '', ['class' => 'form-control', 'placeholder' => 'Post Code'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('swaddress_type', 'Address Type')}}
                        {!! Form::select('swaddress_type', array('Work' => 'Work', 'Home' => 'Home', 'School' => 'School', 'Contact' => 'Contact')) !!}

                    </div>
                </fieldset>



                {{{Form::submit('Submit', ['class' => 'btn btn-primary'])}}}
                {!! Form::close() !!}
            </div>
        </div>
        <hr>
        <a href="/serviceUsers" class="btn btn-primary">Go Back</a>
    </div>
@endsection