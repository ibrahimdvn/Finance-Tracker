<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Personal Finance Tracker</title>
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { background: #f6f7fa; font-family: 'Nunito', sans-serif; margin:0; }
        .auth-container {
            max-width: 400px;
            margin: 60px auto 0 auto;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 24px 0 rgba(30,34,90,0.08);
            padding: 38px 28px 28px 28px;
            text-align: center;
        }
        .logo { width: 54px; height: 54px; margin-bottom: 14px; display: inline-block; }
        .auth-title { font-size: 1.5rem; font-weight: 800; margin-bottom: 8px; }
        .auth-desc { font-size: 1.02rem; color: #6b7280; margin-bottom: 22px; }
        .auth-form { text-align: left; margin-bottom: 18px; }
        .auth-form label { font-weight: 600; margin-bottom: 4px; display: block; }
        .auth-form input[type="email"], .auth-form input[type="password"] {
            width: 100%; padding: 8px 10px; border: 1px solid #e5e7eb; border-radius: 6px; font-size: 0.98rem; margin-bottom: 8px;
        }
        .auth-form input:focus { outline: none; border-color: #2563eb; box-shadow: 0 0 0 2px #2563eb22; }
        .auth-form .remember { display: flex; align-items: center; margin-bottom: 12px; }
        .auth-form .remember input { margin-right: 6px; }
        .btn-main { background: #2563eb; color: #fff; border: none; border-radius: 6px; padding: 10px 0; width: 100%; font-size: 1.1rem; font-weight: 700; cursor: pointer; margin-top: 6px; transition: background 0.2s; }
        .btn-main:hover { background: #1d4ed8; }
        .auth-links { margin-top: 18px; font-size: 0.98rem; color: #6b7280; }
        .auth-links a { color: #2563eb; text-decoration: none; font-weight: 600; margin-left: 4px; }
        .auth-links a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="logo">
            <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="48" height="48" rx="12" fill="#2563eb"/><path d="M14 32V16a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H16a2 2 0 0 1-2-2Z" fill="#fff"/><path d="M20 24h8M24 20v8" stroke="#2563eb" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </div>
        <div class="auth-title">Welcome Back</div>
        <div class="auth-desc">Log in to your Personal Finance Tracker account</div>
        @if (session('status'))
            <div style="color:#10b981; margin-bottom:12px; font-weight:600;">{{ session('status') }}</div>
        @endif
        <form method="POST" action="{{ route('login') }}" class="auth-form">
            @csrf
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
            @error('email')<div style="color:#ef4444; font-size:0.97rem; margin-bottom:8px;">{{ $message }}</div>@enderror
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password">
            @error('password')<div style="color:#ef4444; font-size:0.97rem; margin-bottom:8px;">{{ $message }}</div>@enderror
            <div class="remember">
                <input id="remember_me" type="checkbox" name="remember">
                <label for="remember_me" style="margin-bottom:0; font-weight:400; color:#555;">Remember me</label>
            </div>
            <button type="submit" class="btn-main">Log In</button>
        </form>
        <div class="auth-links">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">Forgot your password?</a>
            @endif
            <br>
            Don't have an account?
            <a href="{{ route('register') }}">Register</a>
        </div>
    </div>
</body>
</html>
