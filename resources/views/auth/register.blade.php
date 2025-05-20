<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-b from-gray-900 to-black">
        <div class="w-full sm:max-w-4xl mt-6 px-6 py-4 bg-gray-800/50 backdrop-blur-lg shadow-xl overflow-hidden sm:rounded-lg border border-gray-700/50">
            <div class="mb-8 text-center">
                <a href="{{ route('home') }}" class="inline-flex items-center space-x-2">
                    <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-gamepad text-2xl text-white"></i>
                    </div>
                    <span class="text-2xl font-bold bg-gradient-to-r from-indigo-400 to-purple-500 bg-clip-text text-transparent">Agac</span>
                </a>
                <h2 class="mt-6 text-2xl font-bold text-gray-200">Create your account</h2>
                <p class="mt-2 text-sm text-gray-400">Join our gaming community today</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Left Column -->
                    <div class="space-y-6">
                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Name')" class="text-gray-300" />
                            <div class="mt-2 relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user text-gray-400"></i>
                                </div>
                                <x-text-input id="name" 
                                            class="block mt-1 w-full pl-10 bg-gray-700/50 border-gray-600 text-gray-200 focus:border-indigo-500 focus:ring-indigo-500" 
                                            type="text" 
                                            name="name" 
                                            :value="old('name')" 
                                            required 
                                            autofocus 
                                            autocomplete="name" 
                                            placeholder="Enter your name" />
                            </div>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Nickname -->
                        <div>
                            <x-input-label for="nickname" :value="__('Nickname')" class="text-gray-300" />
                            <div class="mt-2 relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user-tag text-gray-400"></i>
                                </div>
                                <x-text-input id="nickname" 
                                            class="block mt-1 w-full pl-10 bg-gray-700/50 border-gray-600 text-gray-200 focus:border-indigo-500 focus:ring-indigo-500" 
                                            type="text" 
                                            name="nickname" 
                                            :value="old('nickname')" 
                                            required 
                                            autocomplete="nickname" 
                                            placeholder="Choose a nickname" />
                            </div>
                            <x-input-error :messages="$errors->get('nickname')" class="mt-2" />
                        </div>

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
                                            autocomplete="username" 
                                            placeholder="Enter your email" />
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-6">
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
                                            autocomplete="new-password" 
                                            placeholder="Create a password" />
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-300" />
                            <div class="mt-2 relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                                <x-text-input id="password_confirmation" 
                                            class="block mt-1 w-full pl-10 bg-gray-700/50 border-gray-600 text-gray-200 focus:border-indigo-500 focus:ring-indigo-500" 
                                            type="password" 
                                            name="password_confirmation" 
                                            required 
                                            autocomplete="new-password" 
                                            placeholder="Confirm your password" />
                            </div>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <!-- Password Requirements -->
                        <div class="bg-gray-700/30 rounded-lg p-4 border border-gray-600/50">
                            <h3 class="text-sm font-medium text-gray-300 mb-2">Password Requirements:</h3>
                            <ul class="text-xs text-gray-400 space-y-1">
                                <li class="flex items-center">
                                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                    At least 8 characters long
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                    Include uppercase and lowercase letters
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                    Include at least one number
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="mt-8">
                    <x-primary-button class="w-full justify-center bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 border-0">
                        <i class="fas fa-user-plus mr-2"></i>
                        {{ __('Create Account') }}
                    </x-primary-button>
                </div>

                <div class="text-center">
                    <p class="text-sm text-gray-400">
                        {{ __('Already have an account?') }}
                        <a href="{{ route('login') }}" class="text-indigo-400 hover:text-indigo-300 transition-colors duration-200">
                            {{ __('Sign in') }}
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
