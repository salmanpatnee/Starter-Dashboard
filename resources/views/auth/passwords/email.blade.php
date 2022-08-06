@extends('layouts.auth')
@section('title')
    Reset Password
@endsection

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-group">
            <label class="control-label" for="username">Email</label>
            <input type="email" placeholder="Email" title="Email" required="" value="{{ old('email') }}" name="email"
                id="email" class="form-control" required autocomplete="email" autofocus>
        </div>
        <div>
            <button type="submit" class="btn btn-success btn-block">Send Password Reset Link</button>
        </div>
    </form>
@endsection
