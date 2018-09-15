@extends('layouts.app2')

@section('content')
    <div class="content">
        <span class="img-container">
            <img src="img/medium-logo.svg" alt="img-logo">
        </span>
        <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
            @csrf
            <div class="form-group row">
                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" placeholder="Full Name" value="{{ old('name') }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                    @endif
            </div>
            <div class="form-group row">
                    <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" placeholder="Username" value="{{ old('username') }}" required autofocus>

                    @if ($errors->has('username'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                    @endif
            </div>
            <div class="form-group row">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="Email Address" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
            </div>
            <div class="form-group row">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
            </div>
            <div class="form-group row">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
            </div>
            <div class="form-group row">

                    <button type="submit" class="btn btn-primary">
                        {{ __('Register') }}
                    </button>
                    <div class="col">
                        <p class="form__text">Already Registered? <a href="/login" class="form__cta">{{ __(' Login') }}</a></p>
                    </div>

            </div>
        </form>
    </div>

@endsection
