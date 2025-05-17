<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Agac</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron :wght@500;700&display=swap" rel="stylesheet">

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons "></script>

    @vite('resources/css/app.css')

    <style>
        body {
            font-family: 'Orbitron', sans-serif;
        }

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

        /* Container with hover animation */
        .card {
            position: relative;
            overflow: hidden;
        }

        .character {
            position: absolute;
            font-size: 1.5rem;
            opacity: 0;
            transition: all 0.5s ease-in-out;
            z-index: 0;
        }

        .card:hover .character {
            opacity: 1;
            transform: translate(0, 0);
        }

        .char-top-left {
            top: -20px;
            left: -20px;
            transform: translate(-20px, -20px);
        }

        .char-top-right {
            top: -20px;
            right: -20px;
            transform: translate(20px, -20px);
        }

        .char-bottom-left {
            bottom: -20px;
            left: -20px;
            transform: translate(-20px, 20px);
        }

        .char-bottom-right {
            bottom: -20px;
            right: -20px;
            transform: translate(20px, 20px);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-900 via-slate-900 to-black min-h-screen flex items-center justify-center px-4 overflow-hidden">

    <!-- Optional Background Texture -->
    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/black-mamba.png ')] opacity-10 mix-blend-overlay pointer-events-none"></div>

    <!-- Card -->
    <div class="card w-full max-w-md bg-gray-800/70 backdrop-blur-xl rounded-2xl shadow-2xl p-8 border border-gray-700 z-10 transform transition-all duration-500 hover:shadow-blue-500/20 hover:shadow-2xl">

        <!-- Game Characters (emojis for now, replace with SVG if desired) -->
        <div class="char-top-left character">🎮</div>
        <div class="char-top-right character">👾</div>
        <div class="char-bottom-left character">🕹️</div>
        <div class="char-bottom-right character">💥</div>

        <!-- Title -->
        <h1 class="text-4xl font-extrabold text-center text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-purple-500 to-pink-500 mb-4 tracking-wide">
            Join Agac
        </h1>

        <!-- Subtitle -->
        <p class="text-center text-gray-400 mb-6 text-sm">
            Level up your gaming experience
        </p>

        <!-- Form -->
        <form method="POST" class="space-y-6">
            @csrf

            <!-- Nickname -->
            <div class="input-field">
                <input type="text" id="nickname" name="nickname" required
                    class="w-full px-4 py-3 bg-gray-900/50 border-b-2 border-gray-600 text-white placeholder-transparent focus:outline-none focus:border-blue-500 transition duration-300"
                    minlength="1" maxlength="255">
                <label for="nickname" class="floating-label">Nickname</label>
                <i data-feather="user" class="absolute right-3 top-3.5 text-gray-400"></i>
            </div>

            <!-- Email -->
            <div class="input-field">
                <input type="email" id="email" name="email" required
                    class="w-full px-4 py-3 bg-gray-900/50 border-b-2 border-gray-600 text-white placeholder-transparent focus:outline-none focus:border-blue-500 transition duration-300"
                    minlength="1" maxlength="255">
                <label for="email" class="floating-label">Email Address</label>
                <i data-feather="mail" class="absolute right-3 top-3.5 text-gray-400"></i>
            </div>

            <!-- Password -->
            <div class="input-field">
                <input type="password" id="password" name="password" required
                    class="w-full px-4 py-3 bg-gray-900/50 border-b-2 border-gray-600 text-white placeholder-transparent focus:outline-none focus:border-blue-500 transition duration-300"
                    minlength="8">
                <label for="password" class="floating-label">Password</label>
                <i data-feather="lock" class="absolute right-3 top-3.5 text-gray-400"></i>
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <button type="submit"
                    class="w-full group relative overflow-hidden bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-bold py-3 px-4 rounded-lg shadow-lg transition-all duration-300 transform hover:scale-105 hover:shadow-blue-500/30">
                    <span class="z-10 relative">Create Account</span>
                    <span class="absolute inset-0 w-0 h-full bg-white opacity-10 group-hover:w-full transition-all duration-500 ease-out"></span>
                </button>
            </div>
        </form>
    </div>

    <!-- Initialize Icons -->
    <script>
        feather.replace();
    </script>
</body>
</html>