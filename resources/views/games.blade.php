<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Games - GameHub</title>

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

        /* Page Header */
        .page-header {
            position: relative;
            margin-bottom: 2rem;
        }

        .page-header::after {
            content: '';
            position: absolute;
            bottom: -0.5rem;
            left: 0;
            width: 50px;
            height: 2px;
            background: linear-gradient(90deg, #3b82f6, #8b5cf6);
        }

        /* Game Card */
        .game-card {
            position: relative;
            background: rgba(30, 30, 30, 0.85);
            border-radius: 1rem;
            overflow: hidden;
            transition: all 0.4s ease-in-out;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.1);
        }

        .game-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        }

        .game-card::before {
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

        .game-image {
            position: relative;
            width: 100%;
            height: 200px;
            overflow: hidden;
        }

        .game-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease-in-out;
        }

        .game-card:hover .game-image img {
            transform: scale(1.1);
        }

        .game-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, transparent, rgba(0, 0, 0, 0.8));
            opacity: 0;
            transition: opacity 0.4s ease-in-out;
            display: flex;
            items-center;
            justify-content: center;
        }

        .game-card:hover .game-overlay {
            opacity: 1;
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

        /* Steam Connect Card */
        .steam-connect {
            position: relative;
            background: rgba(30, 30, 30, 0.85);
            border-radius: 1.5rem;
            padding: 2rem;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.1);
            transition: all 0.4s ease-in-out;
            overflow: hidden;
        }

        .steam-connect:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        }

        .steam-connect::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, #60a5fa, transparent);
            animation: borderGlow 3s infinite;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-state-icon {
            width: 5rem;
            height: 5rem;
            margin: 0 auto 1.5rem;
            background: rgba(0, 0, 0, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 2rem;
        }

        .pagination-link {
            position: relative;
            padding: 0.5rem 1rem;
            background: rgba(30, 30, 30, 0.85);
            border-radius: 0.5rem;
            color: white;
            transition: all 0.3s ease;
        }

        .pagination-link:hover {
            background: rgba(59, 130, 246, 0.2);
            transform: translateY(-2px);
        }

        .pagination-link.active {
            background: linear-gradient(90deg, #3b82f6, #8b5cf6);
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

    <!-- Games Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-500">
                My Games
            </h1>
            <p class="mt-2 text-gray-400">Browse and manage your game collection</p>
        </div>

        <!-- Steam Connection Status -->
        @if(!$user->steam_id)
            <div class="steam-connect mb-8">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-gray-800 rounded-full flex items-center justify-center">
                            <i class="fab fa-steam text-2xl text-gray-600"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium text-white">Connect Your Steam Account</h3>
                            <p class="text-sm text-gray-400">Import your Steam games to get started</p>
                        </div>
                    </div>
                    <a href="/steam/redirect" class="btn-primary">
                        Connect Steam
                    </a>
                </div>
            </div>
        @endif

        <!-- Games Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($games as $game)
                <div class="game-card">
                    <div class="game-image">
                        <img src="{{ $game->image_url }}" alt="{{ $game->name }}">
                        <div class="game-overlay">
                            <a href="{{ $game->store_url }}" target="_blank" class="btn-primary">
                                View on Steam
                            </a>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-medium text-white truncate">{{ $game->name }}</h3>
                        <p class="mt-1 text-sm text-gray-400">
                            Playtime: {{ $game->playtime_forever ? round($game->playtime_forever / 60, 1) . ' hours' : 'Not played' }}
                        </p>
                        @if($game->playtime_2weeks)
                            <p class="text-sm text-gray-400">
                                Last 2 weeks: {{ round($game->playtime_2weeks / 60, 1) }} hours
                            </p>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="fas fa-gamepad text-3xl text-gray-600"></i>
                        </div>
                        <h3 class="text-lg font-medium text-white">No Games Found</h3>
                        <p class="mt-2 text-sm text-gray-400">
                            Connect your Steam account to import your game library.
                        </p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($games->hasPages())
            <div class="pagination">
                @foreach($games->getUrlRange(1, $games->lastPage()) as $page => $url)
                    <a href="{{ $url }}" class="pagination-link {{ $page == $games->currentPage() ? 'active' : '' }}">
                        {{ $page }}
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html> 