@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div style="max-width: 400px; margin: 0 auto; padding: 20px;">
    <h1>Register</h1>

    @if ($errors->any())
        <div style="color: red; margin-bottom: 10px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div style="margin-bottom: 15px;">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required style="width: 100%; padding: 8px; margin-top: 5px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required style="width: 100%; padding: 8px; margin-top: 5px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required style="width: 100%; padding: 8px; margin-top: 5px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required style="width: 100%; padding: 8px; margin-top: 5px;">
        </div>

        <button type="submit" style="width: 100%; padding: 10px; background-color: #2563eb; color: white; border: none; border-radius: 4px; cursor: pointer;">Register</button>
    </form>

    <p style="margin-top: 20px; text-align: center;">
        Al een account? <a href="{{ route('login') }}" style="color: #2563eb;">Login hier</a>
    </p>
    <p style="margin-top: 10px; text-align: center;">
        <a href="/">Back to Home</a>
    </p>
</div>
@endsection