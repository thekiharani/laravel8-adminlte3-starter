@extends('layouts.guest')

@section('content')
<div class="card card-outline card-primary">
    <p class="card-header h3 text-center">{{ __('Login') }}</p>
    <div class="card-body login-card-body">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="input-group mb-3">
                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email/Phone Number" value="{{ old('email') }}" required autocomplete="email" autofocus>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user-check"></span>
                    </div>
                </div>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="input-group mb-3">
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" required autocomplete="current-password" placeholder="Password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-unlock"></span>
                    </div>
                </div>
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="input-group mb-3">
                <div class="icheck-primary">
                    <input type="checkbox" name="show_pass" id="show_pass">
                    <label for="show_pass">
                        {{ __('Show Password') }}
                    </label>
                </div>
            </div>

            <div class="input-group">
                <button type="submit" class="btn btn-primary btn-block">
                    {{ __('Login') }}
                    <i class="fas fa-check-circle ml-2"></i>
                </button>
            </div>
        </form>
    </div>
    @if (Route::has('password.request') || Route::has('register'))
        <div class="card-footer">
            @if (Route::has('password.request'))
                <div class="form-group">
                    <a class="btn btn-danger btn-block btn-customized" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                </div>
            @endif

            @if (Route::has('register'))
                <p class="text-center text-md">{{ __('-OR-') }}</p>
                <div class="form-group">
                    <a class="btn btn-success btn-block btn-customized" href="{{ route('register') }}">
                        {{ __('Have no Account? Register') }}
                    </a>
                </div>
            @endif
        </div>
    @endif
</div>
@endsection
