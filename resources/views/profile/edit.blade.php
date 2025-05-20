<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-gray-800/50 backdrop-blur-lg shadow-xl sm:rounded-lg border border-gray-700/50">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-gray-800/50 backdrop-blur-lg shadow-xl sm:rounded-lg border border-gray-700/50">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-gray-800/50 backdrop-blur-lg shadow-xl sm:rounded-lg border border-gray-700/50">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Steam Account') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Connect your Steam account to sync your game library.') }}
                            </p>
                        </header>

                        @if (session('status') === 'steam-connected')
                            <div class="mt-4 text-sm text-green-600">
                                {{ __('Steam account connected successfully!') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="mt-4 text-sm text-red-600">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="mt-4">
                            @if (auth()->user()->steam_id)
                                <p class="text-sm text-gray-600">
                                    {{ __('Steam account connected.') }}
                                </p>
                            @else
                                <a href="{{ route('steam.connect') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                    {{ __('Connect Steam Account') }}
                                </a>
                            @endif
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
