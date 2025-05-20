<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - GameHub</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&display=swap" rel="stylesheet">

    <!-- Vite Assets -->
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    <style>
        body {
            font-family: 'Orbitron', sans-serif;
            background: linear-gradient(145deg, #0f0f0f, #1a1a1a);
            overflow: hidden;
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

        /* Card Styles */
        .card {
            position: relative;
            width: 90%;
            max-width: 400px;
            padding: 2rem;
            background: rgba(30, 30, 30, 0.85);
            border-radius: 1.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.1);
            transition: all 0.4s ease-in-out;
            z-index: 1;
            overflow: hidden;
        }

        .card:hover {
            transform: scale(1.03);
        }

        /* Inner Glare */
        .glare {
            position: absolute;
            width: 200%;
            height: 60px;
            top: -30px;
            left: -50%;
            background: linear-gradient(to bottom, rgba(255,255,255,0.2) 0%, transparent 70%);
            animation: glide 3s infinite ease-in-out;
            pointer-events: none;
            z-index: 0;
        }

        @keyframes glide {
            0% { transform: translateX(0); }
            50% { transform: translateX(-50%); }
            100% { transform: translateX(0); }
        }

        /* Character Silhouettes */
        .characters {
            position: absolute;
            inset: -20px;
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
            z-index: 0;
        }

        .card:hover .characters {
            opacity: 1;
        }

        .char {
            position: absolute;
            width: 40px;
            height: auto;
            opacity: 0.15;
            filter: brightness(0.7);
        }

        .char-top-left {
            top: 0; left: 0;
            transform: translate(-50%, -50%);
        }

        .char-top-right {
            top: 0; right: 0;
            transform: translate(50%, -50%);
        }

        .char-bottom-left {
            bottom: 0; left: 0;
            transform: translate(-50%, 50%);
        }

        .char-bottom-right {
            bottom: 0; right: 0;
            transform: translate(50%, 50%);
        }

        /* Register Link Glow */
        .register-link {
            position: relative;
            font-weight: medium;
            color: #60a5fa;
            transition: all 0.3s ease-in-out;
        }

        .register-link::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(96, 165, 250, 0.2);
            border-radius: 9999px;
            opacity: 0;
            transition: all 0.3s ease;
            filter: blur(4px);
            z-index: -1;
        }

        .register-link:hover {
            color: #bfdbfe;
        }

        .register-link:hover::before {
            opacity: 1;
        }

        /* Floating Labels */
        .input-field {
            position: relative;
        }

        .floating-label {
            position: absolute;
            top: 50%;
            left: 12px;
            transform: translateY(-50%);
            pointer-events: none;
            transition: 0.3s ease all;
            color: #71717a;
            font-size: 0.9rem;
        }

        .input-field input:focus + .floating-label,
        .input-field input:not(:placeholder-shown) + .floating-label {
            top: -8px;
            left: 8px;
            background-color: #18181b;
            padding: 0 4px;
            font-size: 0.75rem;
            color: #3b82f6;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center px-4 relative">

    <!-- Animated Background -->
    <div class="bg-stars" aria-hidden="true">
        @for ($i = 0; $i < 100; $i++)
            <div class="star" style="top: {{ rand(0, 100) }}%; left: {{ rand(0, 100) }}%; width: {{ rand(1, 3) }}px; height: {{ rand(1, 3) }}px;"></div>
        @endfor
    </div>

    <!-- Logo -->
    <a href="/welcome" class="logo">GameHub</a>

    <!-- Login Card -->
    <div class="card relative group mx-auto my-10">

        <!-- Glare -->
        <div class="glare"></div>

        <!-- Silhouettes -->
        <div class="characters">
            <img src="{{ asset('svg/mario-silhouette.svg') }}" class="char char-top-left" alt="Mario">
            <img src="{{ asset('svg/link-silhouette.svg') }}" class="char char-top-right" alt="Link">
            <img src="{{ asset('svg/sonic-silhouette.svg') }}" class="char char-bottom-left" alt="Sonic">
            <img src="{{ asset('svg/pacman-silhouette.svg') }}" class="char char-bottom-right" alt="Pac-Man">
        </div>

        <!-- Title -->
        <h1 class="text-4xl font-extrabold text-center text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-purple-500 to-pink-500 mb-4 tracking-wide animate-pulse">
            Welcome Back
        </h1>

        <p class="text-center text-gray-400 mb-6 text-sm">
            Ready to continue your gaming journey?
        </p>

        <!-- Form -->
        <form method="POST" class="space-y-6 relative z-10">
            @csrf

            <!-- Nickname -->
            <div class="input-field">
                <input type="text" id="nickname" name="nickname" required
                    class="w-full px-4 py-3 bg-gray-900/50 border-b-2 border-gray-600 text-white placeholder-transparent focus:outline-none focus:border-blue-500 transition duration-300"
                    minlength="1" maxlength="255">
                <label for="nickname" class="floating-label">Nickname</label>
            </div>

            <!-- Email -->
            <div class="input-field">
                <input type="email" id="email" name="email" required
                    class="w-full px-4 py-3 bg-gray-900/50 border-b-2 border-gray-600 text-white placeholder-transparent focus:outline-none focus:border-blue-500 transition duration-300"
                    minlength="1" maxlength="255">
                <label for="email" class="floating-label">Email Address</label>
            </div>

            <!-- Password -->
            <div class="input-field">
                <input type="password" id="password" name="password" required
                    class="w-full px-4 py-3 bg-gray-900/50 border-b-2 border-gray-600 text-white placeholder-transparent focus:outline-none focus:border-blue-500 transition duration-300"
                    minlength="8">
                <label for="password" class="floating-label">Password</label>
            </div>

            @if($errors->any())
                <div class="bg-red-500/10 border border-red-500/20 text-red-500 px-4 py-3 rounded relative" role="alert">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Submit Button -->
            <div class="pt-2">
                <button type="submit"
                    class="w-full group relative overflow-hidden bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-bold py-3 px-4 rounded-lg shadow-lg transition-all duration-300 transform hover:scale-105 hover:shadow-blue-500/30">
                    <span class="z-10 relative">Sign In</span>
                    <span class="absolute inset-0 w-0 h-full bg-white opacity-10 group-hover:w-full transition-all duration-500 ease-out"></span>
                </button>
            </div>

            <!-- Register Redirect Link -->
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-400">
                    Don't have an account?
                    <a href="/register" class="register-link">
                        Create one here
                    </a>
                </p>
            </div>
        </form>
    </div>
</body>
</html>

