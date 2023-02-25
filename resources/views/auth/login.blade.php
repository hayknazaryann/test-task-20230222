@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row login-row justify-content-center min-vh-100">
        <div class="col-md-4">
            <div class="login-card">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="row justify-content-center">
                        <div class="col-md-10 mb-3">
                            <label for="username" class="text-md-end">{{ __('Email Address') }}</label>
                            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="col-md-10 mb-3">
                            <label for="password" class="text-md-end">{{ __('Password') }}</label>

                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="col-md-10 mb-3">
                            <button type="submit" class="btn btn-primary w-100">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
