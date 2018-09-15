@extends('layouts.app')

@section('content')
    <div class="col-md-9 col-sm-11 px-5 pl-md-2 pt-2 main mx-auto">
        <a href="#" data-target="#sidebar" data-toggle="collapse" aria-expanded="false"><i class="fa fa-bars fa-2x py-2 p-1"></i></a>

        <div class="card">
            <div class="card-header">Events Calendar</div>
            <div class="card-body">
                <form method="POST" action="{{ route('events.store') }}" aria-label="{{ __('Add Session') }}" files="true">
                    @csrf
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <div class="form-group">
                                <label for="session_type">{{ __('Session Type:') }}</label>

                                <div>
                                    <input id="session_type" type="text" class="form-control{{ $errors->has('session_type') ? ' is-invalid' : '' }}" name="session_type" autofocus>

                                    @if ($errors->has('session_type'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('session_type') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-3 col-sm-3 col-md-3">
                                <div class="form-group">
                                    <label for="start_date">{{ __('Start Date:') }}</label>

                                    <div>
                                        <input id="start_date" type="date" class="form-control{{ $errors->has('start_date') ? ' is-invalid' : '' }}" name="start_date" autofocus>

                                        @if ($errors->has('start_date'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('start_date') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-3 col-sm-3 col-md-3">
                                <div class="form-group">
                                    <label for="end_date">{{ __('End Date:') }}</label>

                                    <div>
                                        <input id="end_date" type="date" class="form-control{{ $errors->has('end_date') ? ' is-invalid' : '' }}" name="end_date" autofocus>

                                        @if ($errors->has('end_date'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('end_date') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-3 col-sm-3 col-md-2">
                                <div class="form-group">
                                    <label for="start_time">{{ __('Start Time:') }}</label>

                                    <div>
                                        <input id="start_date" type="time" class="form-control{{ $errors->has('start_time') ? ' is-invalid' : '' }}" name="start_time" autofocus>

                                        @if ($errors->has('start_time'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('start_time') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-3 col-sm-3 col-md-2">
                                <div class="form-group">
                                    <label for="end_time">{{ __('End Time:') }}</label>

                                    <div>
                                        <input id="end_time" type="time" class="form-control{{ $errors->has('end_time') ? ' is-invalid' : '' }}" name="end_time" autofocus>

                                        @if ($errors->has('end_time'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('end_time') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-1 col-sm-1 col-md-1 text-center"><br>
                                <input type="submit" value="Add Event" class="btn btn-primary">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">

            <div class="card-header">

                MY Calender

            </div>

            <div class="card-body" id="calendar" >



            </div>

        </div>
    </div>

@endsection


