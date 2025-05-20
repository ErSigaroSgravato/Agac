<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - GameHub</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&display=swap" rel="stylesheet">

    <!-- Vite Assets -->
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    <style>
        body {
            font-family: 'Orbitron', sans-serif;
            background: linear-gradient(145deg, #0f0f0f, #1a1a1a);
            overflow-x: hidden;
        }

        .bg-stars {
            position: fixed;
            width: 100%;
            height: 100%;
            background: radial-gradient(ellipse at bottom, #0d0d0d 0%, #000000 100%);
            z-index: -1;
        }

        .star {
            position: absolute;
            border-radius: 50%;
            background: white;
            opacity: 0.3;
            animation: twinkle 3s infinite ease-in-out alternate;
        }

        @keyframes twinkle {
            from { opacity: 0.2; }
            to { opacity: 0.8; }
        }

        /* Logo */
        .logo {
            position: absolute;
            top: 1rem;
            left: 1rem;
            font-size: 1.5rem;
            font-weight: bold;
            color: #60a5fa;
            text-shadow: 0 0 10px #60a5faaa;
            transition: all 0.3s ease;
        }

        .logo:hover {
            text-shadow: 0 0 15px #60a5faff;
            transform: scale(1.05);
        }

        /* Profile Card */
        .profile-card {
            position: relative;
            background: rgba(30, 30, 30, 0.85);
            border-radius: 1.5rem;
            padding: 2rem;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.1);
            transition: all 0.4s ease-in-out;
            overflow: hidden;
        }

        .profile-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        }

        .profile-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, #60a5fa, transparent);
            animation: borderGlow 3s infinite;
        }

        @keyframes borderGlow {
            0% { opacity: 0.3; }
            50% { opacity: 1; }
            100% { opacity: 0.3; }
        }

        /* Buttons */
        .btn-primary {
            position: relative;
            overflow: hidden;
            background: linear-gradient(90deg, #3b82f6, #8b5cf6);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(59, 130, 246, 0.3);
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: 0.5s;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-danger {
            position: relative;
            overflow: hidden;
            background: linear-gradient(90deg, #ef4444, #dc2626);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(239, 68, 68, 0.3);
        }

        /* Section Headers */
        .section-header {
            position: relative;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
        }

        .section-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 2px;
            background: linear-gradient(90deg, #3b82f6, #8b5cf6);
        }

        /* Info Grid */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
        }

        .info-item {
            background: rgba(0, 0, 0, 0.2);
            padding: 1rem;
            border-radius: 0.5rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .info-label {
            color: #9ca3af;
            font-size: 0.875rem;
            margin-bottom: 0.25rem;
        }

        .info-value {
            color: white;
            font-size: 1.125rem;
            font-weight: 500;
        }
    </style>
</head>
<body class="min-h-screen">
    <!-- Animated Background -->
    <div class="bg-stars" aria-hidden="true">
        @for ($i = 0; $i < 100; $i++)
            <div class="star" style="top: {{ rand(0, 100) }}%; left: {{ rand(0, 100) }}%; width: {{ rand(1, 3) }}px; height: {{ rand(1, 3) }}px;"></div>
        @endfor
    </div>

    <!-- Logo -->
    <a href="/welcome" class="logo">GameHub</a>

    <!-- Profile Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Profile Header -->
        <div class="profile-card mb-8">
            <div class="section-header">
                <h2 class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-500">
                    Profile Information
                </h2>
            </div>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Nickname</div>
                    <div class="info-value">{{ $user->nickname }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Email</div>
                    <div class="info-value">{{ $user->email }}</div>
                </div>
            </div>
        </div>

        <!-- Steam Integration -->
        <div class="profile-card mb-8">
            <div class="section-header">
                <h2 class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-500">
                    Steam Integration
                </h2>
            </div>
            @if($user->steam_id)
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full flex items-center justify-center">
                            <i class="fab fa-steam text-2xl text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium text-white">Steam Account Connected</h3>
                            <p class="text-sm text-gray-400">Steam ID: {{ $user->steam_id }}</p>
                        </div>
                    </div>
                    <a href="/games" class="btn-primary">
                        View Games
                    </a>
                </div>
            @else
                <div class="text-center py-8">
                    <div class="w-16 h-16 bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fab fa-steam text-3xl text-gray-600"></i>
                    </div>
                    <h3 class="text-lg font-medium text-white mb-2">Steam Account Not Connected</h3>
                    <p class="text-sm text-gray-400 mb-6">
                        Connect your Steam account to import your game library and track your gaming progress.
                    </p>
                    <a href="/steam/redirect" class="btn-primary">
                        Connect Steam Account
                    </a>
                </div>
            @endif
        </div>

        <!-- Account Actions -->
        <div class="profile-card">
            <div class="section-header">
                <h2 class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-500">
                    Account Actions
                </h2>
            </div>
            <div class="flex justify-end">
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="btn-danger">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html> 