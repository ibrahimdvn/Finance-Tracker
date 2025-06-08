<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Personal Finance Tracker</title>
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Nunito', sans-serif;
            background: #f6f7fa;
            color: #222;
        }
        .welcome-container {
            max-width: 600px;
            margin: 60px auto 0 auto;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 24px 0 rgba(30,34,90,0.08);
            padding: 48px 36px 36px 36px;
            text-align: center;
        }
        .logo {
            width: 64px;
            height: 64px;
            margin-bottom: 18px;
            display: inline-block;
        }
        .welcome-title {
            font-size: 2.1rem;
            font-weight: 800;
            margin-bottom: 12px;
            letter-spacing: -1px;
        }
        .welcome-desc {
            font-size: 1.1rem;
            color: #6b7280;
            margin-bottom: 32px;
        }
        .welcome-btns {
            display: flex;
            justify-content: center;
            gap: 18px;
            margin-bottom: 36px;
        }
        .btn-main {
            background: #2563eb;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 12px 32px;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.2s;
        }
        .btn-main:hover { background: #1d4ed8; }
        .features {
            display: flex;
            flex-wrap: wrap;
            gap: 18px;
            justify-content: center;
            margin-bottom: 18px;
        }
        .feature-card {
            background: #f3f4f6;
            border-radius: 10px;
            padding: 18px 20px;
            min-width: 160px;
            flex: 1 1 160px;
            text-align: center;
        }
        .feature-title {
            font-weight: 700;
            margin-bottom: 6px;
            font-size: 1.05rem;
        }
        .feature-desc {
            color: #6b7280;
            font-size: 0.97rem;
        }
        .footer {
            margin-top: 38px;
            text-align: center;
            color: #888;
            font-size: 0.98rem;
        }
        @media (max-width: 700px) {
            .welcome-container { padding: 18px 4px; }
            .features { flex-direction: column; gap: 10px; }
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <div class="logo">
            <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="48" height="48" rx="12" fill="#2563eb"/><path d="M14 32V16a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H16a2 2 0 0 1-2-2Z" fill="#fff"/><path d="M20 24h8M24 20v8" stroke="#2563eb" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </div>
        <div class="welcome-title">Personal Finance Tracker</div>
        <div class="welcome-desc">
            Take control of your finances! Track your income and expenses, analyze your spending, and reach your financial goals with ease.
        </div>
        <div class="welcome-btns">
            <a href="{{ route('login') }}" class="btn-main">Log In</a>
            <a href="{{ route('register') }}" class="btn-main" style="background:#10b981;">Register</a>
        </div>
        <div class="features">
            <div class="feature-card">
                <div class="feature-title">Income & Expense Tracking</div>
                <div class="feature-desc">Easily record and categorize all your financial transactions.</div>
            </div>
            <div class="feature-card">
                <div class="feature-title">Detailed Reports</div>
                <div class="feature-desc">Analyze your finances with modern, filterable reports and PDF export.</div>
            </div>
            <div class="feature-card">
                <div class="feature-title">User Friendly</div>
                <div class="feature-desc">Simple, modern, and responsive design for all devices.</div>
            </div>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Personal Finance Tracker &mdash; All rights reserved.
        </div>
    </div>
</body>
</html>
