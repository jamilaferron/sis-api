<form method="POST" action="SupportWorkersController@store" aria-label="{{ __('Submit) }}">
    @csrf

    <div class="form-group row">
        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

        <div class="col-md-6">
            <input id="name" type="text" placeholder="Full Name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

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
            <input id="email" type="email" placeholder="Email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

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
            <input id="dob" type="date" class="form-control{{ $errors->has('dob') ? ' is-invalid' : '' }}" name="dob" value="{{ old('dob') }}" required autofocus>

            @if ($errors->has('dob'))
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('dob') }}</strong>
                                    </span>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <label for="dbs" class="col-md-4 col-form-label text-md-right">{{ __('DBS Number') }}</label>

        <div class="col-md-6">
            <input id="dbs" type="text" class="form-control{{ $errors->has('dbs') ? ' is-invalid' : '' }}" name="dbs" value="{{ old('dbs') }}" required autofocus>

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
                <option value="part_time">Part_Time</option>
                <option value="full_time">Full_Time</option>
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
            <input id="availability" type="text" class="form-control{{ $errors->has('availability') ? ' is-invalid' : '' }}" name="availability" value="{{ old('availability') }}" required autofocus>

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
            <input id="specialities" type="text" class="form-control{{ $errors->has('specialities') ? ' is-invalid' : '' }}" name="specialities" value="{{ old('specialities') }}" required autofocus>

            @if ($errors->has('specialities'))
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('specialities') }}</strong>
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