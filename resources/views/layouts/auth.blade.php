<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FitCore Gym Management')</title>
    <link rel="stylesheet" href="{{ asset('css/fitcore.css') }}">
    <style>
        .auth-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: radial-gradient(circle at top right, rgba(255, 95, 31, 0.12), transparent 40%),
                        radial-gradient(circle at bottom left, rgba(18, 19, 26, 0.9), #000000);
            padding: 20px;
            position: relative;
        }
        .auth-card {
            width: 100%;
            max-width: 440px;
            padding: 40px;
        }
        .back-home-btn {
            position: absolute;
            top: 24px;
            left: 24px;
            text-decoration: none;
            padding: 10px 18px;
            font-size: 14px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            backdrop-filter: blur(12px);
            background: rgba(18, 19, 26, 0.8);
            border: 1px solid var(--border-surface-variant);
            color: white;
            border-radius: var(--radius-md);
            transition: all 0.2s ease;
            box-shadow: var(--shadow-card);
            z-index: 100;
        }
        .back-home-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
            box-shadow: var(--glow-primary);
        }
        @media (max-width: 600px) {
            .back-home-btn {
                position: relative;
                top: 0;
                left: 0;
                margin-bottom: 16px;
                display: flex;
                justify-content: center;
            }
            .auth-container {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <!-- Floating Back to Home Button -->
        <a href="{{ route('home') }}" class="back-home-btn">
            <span class="material-symbols-outlined" style="font-size: 20px;">arrow_back</span>
            <span>Back to Home</span>
        </a>

        @yield('content')
    </div>
    @yield('scripts')
</body>
</html>
