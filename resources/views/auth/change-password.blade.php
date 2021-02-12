@extends('layouts.guest')

@section('tittle', 'Change Password')

@section('content')
<div class="card card-outline card-primary">
    <p class="card-header h3 text-center">{{ __('Change Password') }}</p>
    <div class="card-body login-card-body">
        @include('layouts._messages')
        @if(Auth::user()->temp_pass)
            <p class="text-info text-center">You are using a temporary, system-generated password. Please change your password to proceed.</p>
        @endif
        <form method="POST" action="{{ route('password.patch') }}">
            @csrf
            @method('PATCH')
            <div class="input-group mb-3">
                <input type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" required autocomplete="current_password" placeholder="Current Password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-unlock"></span>
                    </div>
                </div>
                @error('current_password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="input-group mb-3">
                <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" id="password" required autocomplete="new_password" placeholder="New Password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
                @error('new_password')
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
                    {{ __('Change Password') }}
                    <i class="fas fa-check-circle ml-2"></i>
                </button>
            </div>
        </form>
        @if(!Auth::user()->temp_pass)
            <hr>
            <a href="{{ url()->previous() }}" class="btn btn-secondary btn-block"><i class="fas fa-reply"></i> Back</a>
        @endif
    </div>
</div>
@endsection
