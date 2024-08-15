<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        .login-container h1 {
            margin-bottom: 20px;
            font-size: 24px;
        }

        .login-container input[type="email"],
        .login-container input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .login-container input[type="submit"],
        .login-container button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
            width: calc(100% - 20px);
        }

        .login-container input[type="submit"]:hover,
        .login-container button:hover {
            background-color: #45a049;
        }

        .login-container a {
            display: block;
            margin-top: 10px;
            color: #000;
            text-decoration: none;
        }

        .login-container a:hover {
            text-decoration: underline;
        }

        .login-container span {
            color: red;
            font-size: 12px;
        }
    </style>
</head>
<body>
<div class="login-container">
    <h1>Login</h1>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div>
            <input type="email" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
            @error('email')
            <span>{{ $message }}</span>
            @enderror
        </div>
        <div>
            <input type="password" id="password" name="password" placeholder="Password" required>
            @error('password')
            <span>{{ $message }}</span>
            @enderror
        </div>
        <button type="submit">Login</button>
    </form>
    <a href="#">Forgot your password?</a>


    <br>
    <a href="{{ route('register') }}">Don't have an account? Register</a>
</div>
</body>
</html>
