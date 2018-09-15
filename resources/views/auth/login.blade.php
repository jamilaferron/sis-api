@extends('layouts.app2')

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    @if (session('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>
    @endif
<div class="content">
     <span class="img-container">
         <img src="img/medium-logo.svg" alt="img-logo">
     </span>
    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
        @csrf
        <div class="form-group row">
            <input id="email" type="text" class="form-control{{$errors->has('email') ? 'is-invalid' : ''}}" name="email" placeholder="Email Address/Username" value="{{old('email')}}" required autofocus>
            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{$errors->first('email')}}</strong>
                </span>
            @endif
        </div>
        <div class="form-group row">
            <input id="password" type="password" class="form-control{{$errors->has('password') ? ' is-invalid' : ''}}" name="password" placeholder="Password" required>
            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group row">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{old('remember') ? 'checked' : ''}}>
                <label class="form-check-label" for="remember">
                    {{__('Remember Me')}}
                </label>
            </div>
        </div>
        <div class="form-group row">
            <button type="submit" class="btn btn-primary">
                {{__('Login')}}
            </button>
            <div class="col">
                <p class="form__text"><a href="{{route('password.request')}}" class="form__cta">{{__(' Forgot Your Password?')}}</a></p>
            </div>
        </div>
        <div class="form-group row">
            <p class="form__text">Not yet registered? <a href="/register" class="form__cta">{{__('Register here')}}</a></p>
        </div>
    </form>
</div>
@endsection
