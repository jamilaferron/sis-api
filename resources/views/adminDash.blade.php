@extends('layouts.app')

@section('content')
    <div class="col-md-9 col-sm-11 px-5 pl-md-2 pt-2 main mx-auto">
        <div class="alert alert-success" role="alert">
            <p>You are logged in as an Administrator</p>
        </div>
        <div class="card">
            <div class="card-header">Dashboard</div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                Support Workers: {{$supportworkersCount}}<br>
                Outstanding Reports: {{$reportsCount}}<br>
                Service Users: {{$serviceusersCount}}


            </div>
        </div>
        <hr>

    </div>
@endsection
