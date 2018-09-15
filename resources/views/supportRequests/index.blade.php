@extends('layouts.app')

@section('content')
    <div class="col-md-9 col-sm-11 px-5 pl-md-2 pt-2 main mx-auto">

        <div class="card">
            <div class="card-header">Referrals</div>

            <div class="card-body">
                @if(count($supportRequests) < 0)
                    @foreach ($supportRequests as $supportRequest)
                        <div class="card">
                            <div class="card-header"><a href="/supportRequests/{{$supportRequests->id}}">{{$supportRequests->service_type}}</a></div>
                            <div class="card-footer">Requested on {{$supportRequests->created_at}}</div>
                        </div>
                        <br>
                    @endforeach
                    {{$supportRequests->links()}}
                @else
                    <p>No Referrals found</p>
                @endif
            </div>
        </div>
        <hr>
        @if(Auth::user()->role == 'admin' || Auth::user()->role == 'manager')
        <a href="/supportRequests/create" class="btn btn-primary">Add</a>
        @endif

    </div>
@endsection
