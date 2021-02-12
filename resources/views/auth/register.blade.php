@extends('layouts.guest')

@section('content')
<div class="card card-outline card-primary">
    <p class="card-header h3 text-center">{{ __('Register') }}</p>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="card-body login-card-body">
            <div class="input-group mb-3">
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Full Name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user-check"></span>
                    </div>
                </div>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="input-group mb-3">
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email Address" value="{{ old('email') }}" required autocomplete="email" autofocus>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="input-group mb-3">
                <input type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" placeholder="Phone Number" value="{{ old('phone_number') }}" required autocomplete="phone_number" autofocus>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-mobile"></span>
                    </div>
                </div>
                @error('phone_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="input-group mb-3">
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="input-group mb-3">
                <input type="password" class="form-control" name="password_confirmation" id="password" required autocomplete="current-password" placeholder="Confirm Password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-key"></span>
                    </div>
                </div>
            </div>

            <div class="input-group">
                <div class="icheck-primary">
                    <input type="checkbox" name="show_pass" id="show_pass">
                    <label for="show_pass">
                        {{ __('Show Password') }}
                    </label>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">
                    {{ __('Register') }}
                    <i class="fas fa-check-circle ml-2"></i>
                </button>
            </div>
            @if (Route::has('login'))
                <p class="text-center text-md">{{ __('-OR-') }}</p>
                <div class="form-group">
                    <a class="btn btn-success btn-block btn-customized" href="{{ route('login') }}">
                        {{ __('Already have an Account? Login') }}
                    </a>
                </div>
            @endif
        </div>
    </form>
</div>
@endsection
