@extends('layouts.home')
@section('content')
    <div class="container">
        <h2>Register</h2>
        <form method="POST" action="{{ route('auth.register') }}">
            @csrf
            <div class="form-group">
                <label for="email">Name:</label>
                <input type="text" class="form-control" id="name" placeholder="Enter email" name="name">
                @if ($errors->has('name'))
                    <div class="error">{{ $errors->first('name') }}</div>
                @endif
            </div>
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
            <div class="form-group">
                <label for="pwd">Confirm Password:</label>
                <input type="password" class="form-control" id="confirmpassword" placeholder="Enter Confirm password"
                    name="confirm_password">
                    @if ($errors->has('confirm_password'))
                    <div class="error">{{ $errors->first('confirm_password') }}</div>
                @endif
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>
@endsection
