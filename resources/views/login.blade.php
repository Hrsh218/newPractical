@extends('layouts.home')
@section('content')
    <div class="container">
        @if (session('messages'))
            <div class="alert alert-success">
                {!! session('messages') !!}
            </div>
        @endif
        <h2>Login Form</h2>
        <form method="POST" action="{{ route('auth.postLogin') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                @if ($errors->has('email'))
                    <div class="error">{{ $errors->first('email') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
                @if ($errors->has('password'))
                    <div class="error">{{ $errors->first('password') }}</div>
                @endif
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>
@endsection
