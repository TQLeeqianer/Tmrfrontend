<!-- resources/views/profile/edit.blade.php -->

{{-- @extends('layouts.app') --}}
@include('header');

<style>
    .event-container {
        padding: 20px;
        color: #ffffff;
        background-color: #2c3e50;
        border-radius: 8px;
        max-width: 600px;
        margin: 50px auto;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
    }

    .event-container h1 {
        font-size: 28px;
        text-align: center;
        margin-bottom: 20px;
        color: #ecf0f1;
    }

    .form-label {
        color: #ecf0f1;
        font-weight: bold;
    }

    .form-control {
        background-color: #34495e;
        color: #19191a;
        border: 1px solid #7f8c8d;
    }

    .btn-primary {
        background-color: #2980b9;
        border-color: #2980b9;
    }

    .btn-primary:hover {
        background-color: #3498db;
        border-color: #3498db;
    }

    .alert-success {
        background-color: #27ae60;
        color: #131414;
        border-color: #27ae60;
        text-align: center;
        margin-bottom: 20px;
    }
</style>

<div class="content event-container">
    {{-- <h1>Edit Profile</h1> --}}

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        <h1>Edit Profile</h1>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $profile->email ?? '') }}" disabled>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">New Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>

        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>
@include('footer');
