@extends('layouts.guest')

@section('content')
<div class="card card-outline card-primary">
    <p class="card-header h3 text-center">{{ __('Confirm Password') }}</p>
    <div class="card-body login-card-body">
        <p>{{ __('Please confirm your password before continuing.') }}</p>
        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf
            <div class="input-group mb-3">
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" required autocomplete="current-password" placeholder="Password">
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
                <div class="icheck-primary">
                    <input type="checkbox" name="show_pass" id="show_pass">
                    <label for="show_pass">
                        {{ __('Show Password') }}
                    </label>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">
                    {{ __('Confirm Password') }}
                    <i class="fas fa-check-circle ml-2"></i>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
