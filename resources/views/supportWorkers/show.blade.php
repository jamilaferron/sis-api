@extends('layouts.app')

@section('content')
    <div class="col-md-9 col-sm-11 px-5 pl-md-2 pt-2 main mx-auto">
               @foreach($supportWorkers as $supportWorker)
                <div class="card">
                    <div class="card-header">{{$supportWorker->name}}</div>

                    <div class="card-body">
                        <div>
                            <img class="card-img-top " style="width:100px;" src="/storage/profile_images/{{$supportWorker->profile_image}}" alt="Profile image"><br>
                            {{$supportWorker->username}}
                            {{$supportWorker->dob}}<br>
                            {{$supportWorker->gender}}<br>
                            {{$supportWorker->line1}},
                            @if($supportWorker->line2 != "")
                                {{$supportWorker->line2}},
                            @endif
                            {{ $supportWorker->town_city}},
                            @if($supportWorker->county != "")
                                {{$supportWorker->county}},
                            @endif
                            {{$supportWorker->postcode}}<br>
                            {{$supportWorker->dbs_num}}<br>
                            {{$supportWorker->email}}<br>
                            {{$supportWorker->role}}<br>


                        </div>
                        <hr>
                        <p>{!! $supportWorker->contract_type !!}</p>

                        Availability<br>

                        Monday's - {{json_decode($supportWorker->availability)->Monday}}<br>
                        Tuesday's - {{json_decode($supportWorker->availability)->Tuesday}}<br>
                        Wednesday's - {{json_decode($supportWorker->availability)->Wednesday}}<br>
                        Thursday's - {{json_decode($supportWorker->availability)->Thursday}}<br>
                        Friday's - {{json_decode($supportWorker->availability)->Friday}}<br>
                        Saturday's - {{json_decode($supportWorker->availability)->Saturday}}<br>
                        Sunday's - {{json_decode($supportWorker->availability)->Sunday}}<br><br>

                        Specialises in
                        @foreach(json_decode($supportWorker->specialities) as $specialities )
                            <li>{{$specialities}}</li>
                        @endforeach
                        <small>Started on {{$supportWorker->created_at}}</small>
                        <hr>

                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-primary float-left" data-toggle="modal" data-target="#editSupportWorker">
                            Edit
                        </button>

                        {!!Form::open(['action' => ['UsersController@destroy', $supportWorker->user_id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                        {{Form::hidden('_method', 'DELETE')}}
                        {{Form::submit('Delete', ['class' => 'btn btn-danger float-right'])}}
                        {!! Form::close() !!}
                    </div>
                </div>
        @endforeach
                <hr>
        <a href="/supportWorkers" class="btn btn-primary">Go Back</a>
    </div>

    <!-- The Modal -->
    <div class="modal fade" id="editSupportWorker">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit {{$supportWorker->user_name}}</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form method="POST" action="/supportWorkers/{{$supportWorker->id}}" aria-label="{{ __('Edit Support Worker') }}">
                        @method('PUT')
                        @csrf
                        <legend>Details:</legend>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" placeholder="Full Name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $supportWorker->user_name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" placeholder="Email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $supportWorker->email }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dob" class="col-md-4 col-form-label text-md-right">{{ __('D.O.B') }}</label>

                            <div class="col-md-6">
                                <input id="dob" type="date" class="form-control{{ $errors->has('dob') ? ' is-invalid' : '' }}" name="dob" value="{{ $supportWorker->dob }}" required autofocus>

                                @if ($errors->has('dob'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('dob') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                            <div class="col-md-6">
                                <select id="gender" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" name="gender" value="{{ $supportWorker->gender }}" autofocus>
                                    <option value="">Select</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>

                                @if ($errors->has('gender'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dbs" class="col-md-4 col-form-label text-md-right">{{ __('DBS Number') }}</label>

                            <div class="col-md-6">
                                <input id="dbs" type="text" placeholder="DBS Number" class="form-control{{ $errors->has('dbs') ? ' is-invalid' : '' }}" name="dbs" value="{{ $supportWorker->dbs_num }}" required autofocus>

                                @if ($errors->has('dbs'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('dbs') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="contract_type" class="col-md-4 col-form-label text-md-right">{{ __('Contract Type') }}</label>

                            <div class="col-md-6">
                                <select id="contract_type" class="form-control{{ $errors->has('contract_type') ? ' is-invalid' : '' }}" name="contract_type" required autofocus>
                                    <option value="">Select</option>
                                    <option value="Part_Time">Part Time</option>
                                    <option value="Full_Time">Full Time</option>
                                </select>

                                @if ($errors->has('contract_type'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contract_type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="availability" class="col-md-4 col-form-label text-md-right">{{ __('Availability') }}</label>

                            <div class="col-md-6">
                                <input id="availability" placeholder="Availability" type="text" class="form-control{{ $errors->has('availability') ? ' is-invalid' : '' }}" name="availability" value="{{ $supportWorker->availability }}" required autofocus>

                                @if ($errors->has('availability'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('availability') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="specialities" class="col-md-4 col-form-label text-md-right">{{ __('Specialities') }}</label>

                            <div class="col-md-6">
                                <input id="specialities" placeholder="Specialities" type="text" class="form-control{{ $errors->has('specialities') ? ' is-invalid' : '' }}" name="specialities" value="{{ $supportWorker->specialities }}" required autofocus>

                                @if ($errors->has('Specialities'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('specialities') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <legend>Address:</legend>
                        <div class="form-group row">
                            <label for="line1" class="col-md-4 col-form-label text-md-right">{{ __('Line 1') }}</label>

                            <div class="col-md-6">
                                <input id="line1" placeholder="Line 1" type="text" class="form-control{{ $errors->has('line1') ? ' is-invalid' : '' }}" name="line1" value="{{ $supportWorker->line1 }}" required autofocus>

                                @if ($errors->has('line1'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('line1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="line2" class="col-md-4 col-form-label text-md-right">{{ __('Line 2') }}</label>

                            <div class="col-md-6">
                                <input id="line2" placeholder="Line 2" type="text" class="form-control{{ $errors->has('line2') ? ' is-invalid' : '' }}" name="line2" value="{{ $supportWorker->line2 }}">

                                @if ($errors->has('line2'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('line2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="town" class="col-md-4 col-form-label text-md-right">{{ __('Town') }}</label>

                            <div class="col-md-6">
                                <input id="town" placeholder="Town" type="text" class="form-control{{ $errors->has('town') ? ' is-invalid' : '' }}" name="town" value="{{ $supportWorker->town_city }}" required autofocus>

                                @if ($errors->has('town'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('town') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="county" class="col-md-4 col-form-label text-md-right">{{ __('County') }}</label>

                            <div class="col-md-6">
                                <input id="county" placeholder="County" type="text" class="form-control{{ $errors->has('county') ? ' is-invalid' : '' }}" name="county" value="{{ $supportWorker->county }}" required autofocus>

                                @if ($errors->has('county'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('county') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="postal_code" class="col-md-4 col-form-label text-md-right">{{ __('Postal_code') }}</label>

                            <div class="col-md-6">
                                <input id="postal_code" placeholder="Postal_code" type="text" class="form-control{{ $errors->has('postal_code') ? ' is-invalid' : '' }}" name="postal_code" value="{{ $supportWorker->postcode }}" required autofocus>

                                @if ($errors->has('postal_code'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('postal_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address_type" class="col-md-4 col-form-label text-md-right">{{ __('Address Type') }}</label>

                            <div class="col-md-6">
                                <select id="address_type" class="form-control{{ $errors->has('address_type') ? ' is-invalid' : '' }}" name="address_type" required autofocus>
                                    <option value="">Select</option>
                                    <option value="Work">Work</option>
                                    <option value="Home">Home</option>
                                    <option value="School">School</option>
                                    <option value="Contact">Contact</option>
                                </select>

                                @if ($errors->has('address_type'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address_type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">

                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
@endsection