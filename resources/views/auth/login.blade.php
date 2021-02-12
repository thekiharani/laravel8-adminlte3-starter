@extends('layouts.guest')

@section('content')
<div class="card">
    <p class="card-header h3 text-center">{{ __('Login') }}</p>
    <div class="card-body login-card-body">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="input-group mb-3">
                <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" placeholder="Email/Phone Number" value="{{ old('username') }}" required autocomplete="username" autofocus>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user-check"></span>
                    </div>
                </div>

                @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="input-group mb-3">
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
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

            <div class="row">
                <div class="col-8">
                    <div class="icheck-primary">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember">
                            Remember Me
                        </label>
                    </div>
                </div>
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                </div>
            </div>
        </form>

        @if (Route::has('password.request'))
            <hr>
            <div class="form-group">
                <a class="btn btn-danger btn-block btn-customized" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            </div>
        @endif

        @if (Route::has('register'))
            <hr>
            <div class="form-group">
                <a class="btn btn-success btn-block btn-customized" href="{{ route('register') }}">
                    {{ __('Have no Account? Register') }}
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
