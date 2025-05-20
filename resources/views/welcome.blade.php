<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - GameHub</title>

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

        /* Hero Section */
        .hero {
            position: relative;
            padding: 8rem 0;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at center, rgba(96, 165, 250, 0.1) 0%, transparent 70%);
            z-index: 0;
        }

        /* Feature Cards */
        .feature-card {
            position: relative;
            background: rgba(30, 30, 30, 0.85);
            border-radius: 1.5rem;
            padding: 2rem;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.1);
            transition: all 0.4s ease-in-out;
            overflow: hidden;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        }

        .feature-card::before {
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

        .btn-secondary {
            position: relative;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        /* Feature Icons */
        .feature-icon {
            width: 3rem;
            height: 3rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            border-radius: 1rem;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.1) rotate(5deg);
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

    <!-- Hero Section -->
    <section class="hero">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center">
                <h1 class="text-5xl md:text-6xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-purple-500 to-pink-500 mb-6 tracking-wide animate-pulse">
                    Track Your Games
                    <span class="block mt-2">Like Never Before</span>
                </h1>
                <p class="mt-6 text-xl text-gray-300 max-w-3xl mx-auto">
                    Connect your Steam account, discover new games, and keep track of your gaming journey.
                </p>
                <div class="mt-10 flex justify-center gap-4">
                    @if(!Session::get('is_logged_in'))
                        <a href="/register" class="btn-primary">
                            Get Started
                        </a>
                        <a href="/login" class="btn-secondary">
                            Sign In
                        </a>
                    @else
                        <a href="/games" class="btn-primary">
                            View My Games
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-500">
                    Everything you need to manage your games
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Steam Integration -->
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fab fa-steam text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Steam Integration</h3>
                    <p class="text-gray-400">
                        Connect your Steam account to automatically import your game library.
                    </p>
                </div>

                <!-- Game Tracking -->
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-gamepad text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Game Tracking</h3>
                    <p class="text-gray-400">
                        Keep track of your games, playtime, and achievements in one place.
                    </p>
                </div>

                <!-- Statistics -->
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Statistics</h3>
                    <p class="text-gray-400">
                        View detailed statistics about your gaming habits and preferences.
                    </p>
                </div>

                <!-- Community -->
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-users text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Community</h3>
                    <p class="text-gray-400">
                        Connect with other gamers and share your gaming experiences.
                    </p>
                </div>
            </div>
        </div>
    </section>
</body>
</html>