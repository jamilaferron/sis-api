@extends('layouts.app')

@section('content')
    <div class="col-md-9 col-sm-11 px-5 pl-md-2 pt-2 main mx-auto">
        <div class="card">
            <div class="card-header">Admins</div>

            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-center">
                @if(count($users) > 0)
                    @foreach ($users as $user)

                            <div class="card m-4" style=" width:270px">
                                <img class="card-img-top " style="width:200px;" src="/storage/profile_images/{{$user->profile_image}}" alt="Profile image">
                            <div class="card-body">
                                <h4 class="card-title">{{$user->user_name}}</h4>
                                <p class="card-text">Started on {{$user->created_at}}</p>
                                <a href="/users/{{$user->id}}" class="btn btn-primary">See Profile</a>
                            </div>
                        </div>
                        <br>

                    @endforeach
                </div>
                    {{$users->links()}}
                @else
                    <p>No Admins found</p>
                @endif
            </div>
        </div>
        <hr>

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newUser">
            Add
        </button>
        <a href="/users/create" class="btn btn-primary">+</a>

    </div>

    <!-- The Modal -->
    <div class="modal fade" id="newUser">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add New User</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form method="POST" action="{{ route('users.store') }}" aria-label="{{ __('Add User') }}">
                        @csrf
                        <legend>Details:</legend>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" placeholder="Full Name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" autofocus>

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
                                <input id="email" type="email" placeholder="Email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row dob">
                            <label for="dob" class="col-md-4 col-form-label text-md-right">{{ __('D.O.B') }}</label>

                            <div class="col-md-6">
                                <input id="dob" type="date" class="form-control{{ $errors->has('dob') ? ' is-invalid' : '' }}" name="dob" value="{{ old('dob') }}"autofocus>

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
                                <select id="gender" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" name="gender" autofocus>
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
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                            <div class="col-md-6">
                                <select id="role" class="target tog form-control{{ $errors->has('role') ? ' is-invalid' : '' }}" name="role" autofocus>
                                    <option value="">Select</option>
                                    <option value="superAdmin">Super Admin</option>
                                    <option value="admin">Admin</option>
                                    <option value="manager">Manager</option>
                                    <option value="support worker">Support Worker</option>
                                </select>

                                @if ($errors->has('role'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row swOptions">
                            <label for="dbs" class="col-md-4 col-form-label text-md-right">{{ __('DBS Number') }}</label>

                            <div class="col-md-6">
                                <input id="dbs" type="text" placeholder="DBS Number" class=" tog form-control{{ $errors->has('dbs') ? ' is-invalid' : '' }}" name="dbs" value="{{ old('dbs') }}" autofocus>

                                @if ($errors->has('dbs'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('dbs') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row swOptions">
                            <label for="contract_type" class="col-md-4 col-form-label text-md-right">{{ __('Contract Type') }}</label>

                            <div class="col-md-6">
                                <select id="contract_type" class="form-control{{ $errors->has('contract_type') ? ' is-invalid' : '' }}" name="contract_type" autofocus>
                                    <option value="">Select</option>
                                    <option value="part time">Part Time</option>
                                    <option value="full time">Full Time</option>
                                </select>

                                @if ($errors->has('contract_type'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contract_type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row swOptions">
                            <label for="availability" class="col-md-4 col-form-label text-md-right">{{ __('Availability') }}</label>

                            <div class="col-md-6">
                                <div>
                                    Monday <br>
                                    <input type="radio" id="monaval" name="monavailability" value="Available">Available
                                    <input type="radio" id="monunaval" name="monavailability" value="Unavailable" checked>Unvailable <br>

                                    <div class=" dayOptions monOptions">
                                        Start <input id="monstart_time" type="time" name="start_time[]" class="form-control{{ $errors->has('start_time') ? ' is-invalid' : '' }}" name="start_time" autofocus>
                                        End <input id="monend_time" type="time" name="end_time[]" class="form-control{{ $errors->has('end_time') ? ' is-invalid' : '' }}" name="end_time" autofocus><br>
                                    </div>
                                </div>

                                <div>
                                    Tuesday <br>
                                    <input type="radio" id="tueaval" name="tueavailability" value="Available">Available
                                    <input type="radio" id="tueunaval" name="tueavailability" value="Unavailable"  checked>Unvailable <br>
                                    <div class=" dayOptions tueOptions">
                                        Start <input id="tuestart_time" type="time" name="start_time[]" class="form-control{{ $errors->has('start_time') ? ' is-invalid' : '' }}" name="start_time" autofocus>
                                        End <input id="tueend_time" type="time" name="end_time[]" class="form-control{{ $errors->has('end_time') ? ' is-invalid' : '' }}" name="end_time" autofocus><br>
                                    </div>
                                </div>

                                <div>
                                    Wednesday <br>
                                    <input type="radio" id="wedaval" name="wedavailability" value="Available"> Available
                                    <input type="radio" id="wedunaval" name="wedavailability" value="Unavailable"  checked> Unvailable <br>
                                    <div class=" dayOptions wedOptions">
                                        Start <input id="wedstart_time" type="time" name="start_time[]" class="form-control{{ $errors->has('start_time') ? ' is-invalid' : '' }}" name="start_time" autofocus>
                                        End <input id="wedend_time" type="time" name="end_time[]" class="form-control{{ $errors->has('end_time') ? ' is-invalid' : '' }}" name="end_time" autofocus><br>
                                    </div>
                                </div>

                                <div>
                                    Thursday <br>
                                    <input type="radio" id="thuaval" name="thuravailability" value="Available">Available
                                    <input type="radio" id="thuunaval" name="thuravailability" value="Unavailable"  checked>Unvailable <br>
                                    <div class=" dayOptions thuOptions">
                                        Start <input id="thustart_time" type="time" name="start_time[]" class="form-control{{ $errors->has('start_time') ? ' is-invalid' : '' }}" name="start_time" autofocus>
                                        End <input id="thuend_time" type="time" name="end_time[]" class="form-control{{ $errors->has('end_time') ? ' is-invalid' : '' }}" name="end_time" autofocus><br>
                                    </div>
                                </div>

                                <div>
                                    Friday <br>
                                    <input type="radio" id="friaval" name="friavailability" value="Available">Available
                                    <input type="radio" id="friunaval" name="friavailability" value="Unavailable"  checked>Unvailable <br>
                                    <div class=" dayOptions friOptions">
                                        Start <input id="fristart_time" type="time" name="start_time[]" class="form-control{{ $errors->has('start_time') ? ' is-invalid' : '' }}" name="start_time" autofocus>
                                        End <input id="friend_time" type="time" name="end_time[]" class="form-control{{ $errors->has('end_time') ? ' is-invalid' : '' }}" name="end_time" autofocus><br>
                                    </div>
                                </div>

                                <div>
                                    Saturday <br>
                                    <input type="radio" id="sataval" name="satavailability" value="Available">Available
                                    <input type="radio" id="satunaval" name="satavailability" value="Unavailable"  checked>Unvailable <br>
                                    <div class=" dayOptions satOptions">
                                        Start <input id="satstart_time" type="time" name="start_time[]" class="form-control{{ $errors->has('start_time') ? ' is-invalid' : '' }}" name="start_time" autofocus>
                                        End <input id="satend_time" type="time" name="end_time[]" class="form-control{{ $errors->has('end_time') ? ' is-invalid' : '' }}" name="end_time" autofocus><br>
                                    </div>
                                </div>

                                <div>
                                    Sunday <br>
                                    <input type="radio" id="sunaval" name="sunavailability" value="Available">Available
                                    <input type="radio" id="sununaval" name="sunavailability" value="Unavailable"  checked>Unvailable <br>
                                    <div class=" dayOptions sunOptions">
                                        Start <input id="sunstart_time" type="time" name="start_time[]" class="form-control{{ $errors->has('start_time') ? ' is-invalid' : '' }}" name="start_time" autofocus>
                                        End <input id="sunend_time" type="time" name="end_time[]" class="form-control{{ $errors->has('end_time') ? ' is-invalid' : '' }}" name="end_time" autofocus><br>
                                    </div>
                                </div>



                                @if ($errors->has('availability'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('availability') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row swOptions">

                            <label for="specialities" class="col-md-4 col-form-label text-md-right">{{ __('Specialities') }}</label>

                            <div class="col-md-6">
                                <input type="checkbox" id="specialities" name="specialities[]" value="Challenging Behaviour"> Challenging Behaviour <br>
                                <input type="checkbox" id="specialities" name="specialities[]" value="Autism"> Autism <br>
                                <input type="checkbox" id="specialities" name="specialities[]" value="Epilepsy"> Epilepsy <br>
                                <input type="checkbox" id="availability" name="specialities[]" value="Babies"> Babies <br>
                                <input type="checkbox" id="availability" name="specialities[]" value="Art Therapy"> Art Therapy <br>
                                <input type="checkbox" id="availability" name="specialities[]" value="Semi Independence"> SEmi Independence <br>

                                @if ($errors->has('Specialities'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('specialities') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label for="line1" class="col-md-4 col-form-label text-md-right">{{ __('Address Line 1') }}</label>

                            <div class="col-md-6">
                                <input id="line1" placeholder="Line 1" type="text" class="form-control{{ $errors->has('line1') ? ' is-invalid' : '' }}" name="line1" value="{{ old('line1') }}" autofocus>

                                @if ($errors->has('line1'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('line1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="line2" class="col-md-4 col-form-label text-md-right">{{ __('Address Line 2 (optional)') }}</label>

                            <div class="col-md-6">
                                <input id="line2" placeholder="Line 2" type="text" class="form-control{{ $errors->has('line2') ? ' is-invalid' : '' }}" name="line2" value="{{ old('line2') }}" autofocus>

                                @if ($errors->has('line2'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('line2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="town" class="col-md-4 col-form-label text-md-right">{{ __('Town or City') }}</label>

                            <div class="col-md-6">
                                <input id="town" placeholder="Town" type="text" class="form-control{{ $errors->has('town') ? ' is-invalid' : '' }}" name="town" value="{{ old('town') }}" autofocus>

                                @if ($errors->has('town'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('town') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="county" class="col-md-4 col-form-label text-md-right">{{ __('County (optional)') }}</label>

                            <div class="col-md-6">
                                <input id="county" placeholder="County" type="text" class="form-control{{ $errors->has('county') ? ' is-invalid' : '' }}" name="county" value="{{ old('county') }}" autofocus>

                                @if ($errors->has('county'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('county') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="postcode" class="col-md-4 col-form-label text-md-right">{{ __('Postcode') }}</label>

                            <div class="col-md-6">
                                <input id="postcode" placeholder="Postcode" type="text" class="form-control{{ $errors->has('postcode') ? ' is-invalid' : '' }}" name="postcode" value="{{ old('postal_code') }}" autofocus>

                                @if ($errors->has('postcode'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('postcode') }}</strong>
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

@section('scripts')
    <script>

        $(document).ready(function (){
            $(".swOptions").hide();
            $("#role").change(function() {

                if ($(this).val() === "support worker") {
                    $(".swOptions").show();
                }else{
                    $(".swOptions").hide();
                }
            });
            if(document.getElementById('role').value === "support worker")
            {
                $('.swOptions').show();

            };

            $('.dayOptions').hide();

            $('#monaval').change(function () {
                $('.monOptions').show();
                if(document.getElementById('monaval').checked === true)
                {
                    $('#monstart_time').attr("required", true);
                    $('#monend_time').attr("required", true);

                }
            });
            $('#monunaval').change(function () {
                $('.monOptions').hide();
            });
            if(document.getElementById('monaval').checked === true)
            {
                $('.monOptions').show();

            }

            $('#tueaval').change(function () {
                $('.tueOptions').show();
                if(document.getElementById('tueaval').checked === true)
                {
                    $('#tuestart_time').attr("required", true);
                    $('#tueend_time').attr("required", true);

                }
            });
            $('#tueunaval').change(function () {
                $('.tueOptions').hide();
            });
            if(document.getElementById('tueaval').checked === true)
            {
                $('.tueOptions').show();

            };

            $('#wedaval').change(function () {
                $('.wedOptions').show();
                if(document.getElementById('wedaval').checked === true)
                {
                    $('#wedstart_time').attr("required", true);
                    $('#wedend_time').attr("required", true);

                }
            });
            $('#wedunaval').change(function () {
                $('.wedOptions').hide();
            });
            if(document.getElementById('wedaval').checked === true)
            {
                $('.wedOptions').show();

            };

            $('#thuaval').change(function () {
                $('.thuOptions').show();
                if(document.getElementById('thuaval').checked === true)
                {
                    $('#thustart_time').attr("required", true);
                    $('#thuend_time').attr("required", true);

                }
            });
            $('#thuunaval').change(function () {
                $('.thuOptions').hide();
            });
            if(document.getElementById('thuaval').checked === true)
            {
                $('.thuOptions').show();

            };

            $('#friaval').change(function () {
                $('.friOptions').show();
                if(document.getElementById('friaval').checked === true)
                {
                    $('#fristart_time').attr("required", true);
                    $('#friend_time').attr("required", true);

                }
            });
            $('#friunaval').change(function () {
                $('.friOptions').hide();
            });
            if(document.getElementById('friaval').checked === true)
            {
                $('.friOptions').show();

            };

            $('#sataval').change(function () {
                $('.satOptions').show();
                if(document.getElementById('sataval').checked === true)
                {
                    $('#satstart_time').attr("required", true);
                    $('#satend_time').attr("required", true);

                }
            });
            $('#satunaval').change(function () {
                $('.satOptions').hide();
            });
            if(document.getElementById('sataval').checked === true)
            {
                $('.satOptions').show();

            };

            $('#sunaval').change(function () {
                $('.sunOptions').show();
                if(document.getElementById('sunaval').checked === true)
                {
                    $('#sunstart_time').attr("required", true);
                    $('#sunend_time').attr("required", true);

                }
            });
            $('#sununaval').change(function () {
                $('.sunOptions').hide();
            });
            if(document.getElementById('sunaval').checked === true)
            {
                $('.sunOptions').show();

            };




        });
    </script>
@endsection
