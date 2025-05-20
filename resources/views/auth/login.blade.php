<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-b from-gray-900 to-black">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-gray-800/50 backdrop-blur-lg shadow-xl overflow-hidden sm:rounded-lg border border-gray-700/50">
            <div class="mb-8 text-center">
                <a href="{{ route('home') }}" class="inline-flex items-center space-x-2">
                    <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-gamepad text-2xl text-white"></i>
                    </div>
                    <span class="text-2xl font-bold bg-gradient-to-r from-indigo-400 to-purple-500 bg-clip-text text-transparent">Agac</span>
                </a>
                <h2 class="mt-6 text-2xl font-bold text-gray-200">Welcome back</h2>
                <p class="mt-2 text-sm text-gray-400">Sign in to your account to continue</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-gray-300" />
                    <div class="mt-2 relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <x-text-input id="email" 
                                    class="block mt-1 w-full pl-10 bg-gray-700/50 border-gray-600 text-gray-200 focus:border-indigo-500 focus:ring-indigo-500" 
                                    type="email" 
                                    name="email" 
                                    :value="old('email')" 
                                    required 
                                    autofocus 
                                    autocomplete="username" 
                                    placeholder="Enter your email" />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" class="text-gray-300" />
                    <div class="mt-2 relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <x-text-input id="password" 
                                    class="block mt-1 w-full pl-10 bg-gray-700/50 border-gray-600 text-gray-200 focus:border-indigo-500 focus:ring-indigo-500" 
                                    type="password" 
                                    name="password" 
                                    required 
                                    autocomplete="current-password" 
                                    placeholder="Enter your password" />
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" 
                               type="checkbox" 
                               class="rounded border-gray-600 text-indigo-600 shadow-sm focus:ring-indigo-500 bg-gray-700/50" 
                               name="remember">
                        <span class="ms-2 text-sm text-gray-300">{{ __('Remember me') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-indigo-400 hover:text-indigo-300 transition-colors duration-200" 
                           href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <div>
                    <x-primary-button class="w-full justify-center bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 border-0">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>

                <div class="text-center">
                    <p class="text-sm text-gray-400">
                        {{ __("Don't have an account?") }}
                        <a href="{{ route('register') }}" class="text-indigo-400 hover:text-indigo-300 transition-colors duration-200">
                            {{ __('Sign up') }}
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
