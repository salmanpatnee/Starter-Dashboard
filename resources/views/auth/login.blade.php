@extends('layouts.auth')
@section('title')
    Login
@endsection
@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf
        @error('email')
            <div class="text-danger text-center" role="alert">
                <strong>{{ $message }}</strong>
            </div>
            <hr>
        @enderror
        <div class="form-group">
            <label class="control-label" for="username">Email</label>
            <input type="email" placeholder="Email" title="Email" required="" value="{{ old('email') }}" name="email"
                id="email" class="form-control" required autocomplete="email" autofocus>
            <span class="help-block small">Your unique email</span>

        </div>

        <div class="form-group">
            <label class="control-label" for="password">Password</label>
            <input type="password" title="Please enter your password" placeholder="Password" required="" value=""
                name="password" id="password" class="form-control">
            <span class="help-block small">Your strong password</span>
            @if (Route::has('password.request'))
                <span> <a href="{{ route('password.request') }}">
                        <b class="text-right"> {{ __('Forgot Your Password?') }}</b>
                    </a>
                </span>
            @endif


        </div>

        {{-- <div class="row mb-3">
            <div class="col-md-6 offset-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>
        </div> --}}

        <div>
            <button type="submit" class="btn btn-success">Login</button>
        </div>

    </form>
@endsection
