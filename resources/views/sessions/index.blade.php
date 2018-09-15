@extends('layouts.app')

@section('content')
    <div class="col-md-9 col-sm-11 px-5 pl-md-2 pt-2 main mx-auto">
        <div class="card">
            <div class="card-header">
                MY Calender
            </div>
            <div class="card-body" id="calendar" >
            </div>
        </div>
        <br>
        @if(Auth::user()->role == 'admin' || Auth::user()->role == 'manager')
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editSupportWorker">
                Add Session
            </button>
        @endif
    </div>

    <div id="calendarModal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 id="modalTitle" class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div id="modalBody" class="modal-body"></div>

            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal fade" id="editSupportWorker">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Session</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form method="POST" action="{{ route('sessions.store') }}" aria-label="{{ __('Add Session') }}" files="true">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="session_type">{{ __('Session Type:') }}</label>
                                    <div>
                                        <select id="session_type" class="form-control{{ $errors->has('session_type') ? ' is-invalid' : '' }}" name="session_type" autofocus>
                                            <option value="">select</option>
                                            @foreach($sessionTypes as $sessionType)
                                                <option value="{{$sessionType->service_type}}">{{$sessionType->service_type}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('session_type'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('session_type') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>


                                <div class="col">
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

                                <div class="col">
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
                                <div class="col">
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

                                <div class="col">
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
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Service User</label>
                                        <div>
                                            <select id="serviceuser" class="form-control{{ $errors->has('serviceuser') ? ' is-invalid' : '' }}" name="serviceuser" autofocus>
                                                <option value="">select</option>
                                                @foreach($serviceUsers as $serviceUser)
                                                    <option value="{{$serviceUser->id}}">{{$serviceUser->su_name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('serviceuser'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('serviceuser') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Support Worker</label>
                                        <div>
                                            <select id="supportworker" class="form-control{{ $errors->has('supportworker') ? ' is-invalid' : '' }}" name="supportworker" autofocus>
                                                <option value="">select</option>
                                                @foreach($supportWorkers as $supportWorker)
                                                    <option value="{{$supportWorker->id}}">{{$supportWorker->user_name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('supportworker'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('supportworker') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col otherSupport">
                                    <div class="form-group">
                                        <label for="">Pick up Address</label>
                                        <div>
                                            <select id="address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" autofocus>
                                                <option value="">select</option>
                                                @foreach($addresses as $address)
                                                    <option value="{{$address->id}}">{{$address->line1}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('address'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Drop off Address</label>
                                        <div>
                                            <select id="address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" autofocus>
                                                <option value="">select</option>
                                                @foreach($addresses as $address)
                                                    <option value="{{$address->id}}">{{$address->line1}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('address'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            <div class="form-group home">
                                <label for="">Address</label>
                                <div>
                                    <select id="address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" autofocus>
                                        <option value="">select</option>
                                        @foreach($addresses as $address)
                                            <option value="{{$address->id}}">{{$address->line1}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('address'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                                <div class="col">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Submit') }}
                                        </button>
                                    </div>
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
    <script type="text/javascript">
        $(document).ready(function() {
            // page is now ready, initialize the calendar...
            $('#calendar').fullCalendar({
                // put your options and callbacks here
                events : [
                    @if(Auth::user()->role == 'support worker')
                        @foreach($sessionsInfos as $sessionsInfo)
                            @if(Auth::user()->user_name == $sessionsInfo->user_name)
                                {
                                    title :'{{ $sessionsInfo->start_date }} - {{ $sessionsInfo->su_name }}',
                                    start : '{{ $sessionsInfo->start_date }}',
                                    description:'{{ $sessionsInfo->session_type }}'+'<br>'+'{{ $sessionsInfo->start_time }}' + '-' + '{{ $sessionsInfo->end_time }}',

                                    @if( $sessionsInfo->session_type  == 'Escort')
                                        color: 'purple',
                                    @elseif( $sessionsInfo->session_type  == 'Community Outreach')
                                    color: 'red',
                                    @elseif( $sessionsInfo->session_type  == 'Home Support')
                                    color: 'orange',
                                    @elseif( $sessionsInfo->session_type  == 'Welfare Check')
                                    color: 'green'
                                    @endif
                                },
                            @endif
                        @endforeach
                    @else
                        @foreach($sessionsInfos as $sessionsInfo)
                            {
                                title :'{{ $sessionsInfo->su_name }}',
                                start : '{{ $sessionsInfo->start_date }}',
                                description: 'Support Worker: {{ $sessionsInfo->user_name }} <br> {{ $sessionsInfo->session_type }}'+'<br>'+'{{ $sessionsInfo->start_time }}' + '-' + '{{ $sessionsInfo->end_time }}',

                                @if( $sessionsInfo->session_type  == 'Escort')
                                color: 'purple',
                                @elseif( $sessionsInfo->session_type  == 'Community Outreach')
                                color: 'red',
                                @elseif( $sessionsInfo->session_type  == 'Home Outreach')
                                color: 'orange',
                                @elseif( $sessionsInfo->session_type  == 'Welfare Check')
                                color: 'green'
                                @endif
                            },
                        @endforeach
                    @endif
                ],

                eventClick: function(event) {

                    $('#modalTitle').html(event.title);
                    $('#modalBody').html(event.description);
                    $('#calendarModal').modal();


                }

            });


                $(".otherSupport").hide();
                $("#session_type").change(function() {
                    // foo is the id of the other select box
                    if ($(this).val() === "Home Support" || $(this).val() === "Welfare Check") {
                        $(".home").show();
                        $(".otherSupport").hide();
                    }else{
                        $(".otherSupport").show();
                        $(".home").hide();
                    }
                });

        });
    </script>
@endsection


