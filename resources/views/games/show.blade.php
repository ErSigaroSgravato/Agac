<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800/50 backdrop-blur-lg overflow-hidden shadow-xl sm:rounded-lg border border-gray-700/50">
                <div class="relative">
                    <!-- Hero Image -->
                    <div class="aspect-w-16 aspect-h-9">
                        <img src="{{ $game['background_image'] }}" 
                             alt="{{ $game['name'] }}" 
                             class="object-cover w-full h-full">
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/50 to-transparent"></div>
                    </div>

                    <!-- Game Info Overlay -->
                    <div class="absolute bottom-0 left-0 right-0 p-6">
                        <div class="flex items-end justify-between">
                            <div>
                                <h1 class="text-3xl font-bold text-white mb-2">{{ $game['name'] }}</h1>
                                <div class="flex items-center space-x-4">
                                    @if(isset($game['released']))
                                        <span class="text-gray-300">
                                            <i class="fas fa-calendar-alt mr-1"></i>
                                            {{ \Carbon\Carbon::parse($game['released'])->format('M d, Y') }}
                                        </span>
                                    @endif
                                    @if(isset($game['rating']))
                                        <span class="text-gray-300">
                                            <i class="fas fa-star text-yellow-500 mr-1"></i>
                                            {{ number_format($game['rating'], 1) }}/5
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="flex space-x-3">
                                <button class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 rounded-lg text-white font-medium transition-colors duration-200">
                                    <i class="fas fa-plus mr-2"></i>Add to Library
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Game Details -->
                <div class="p-6">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Main Content -->
                        <div class="lg:col-span-2 space-y-6">
                            @if(isset($game['description']))
                                <div>
                                    <h2 class="text-xl font-semibold text-gray-200 mb-3">About</h2>
                                    <div class="prose prose-invert max-w-none">
                                        {!! $game['description'] !!}
                                    </div>
                                </div>
                            @endif

                            @if(isset($game['platforms']) && count($game['platforms']) > 0)
                                <div>
                                    <h2 class="text-xl font-semibold text-gray-200 mb-3">Platforms</h2>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($game['platforms'] as $platform)
                                            <span class="px-3 py-1 bg-gray-700/50 text-gray-300 rounded-full text-sm">
                                                {{ $platform['platform']['name'] }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Sidebar -->
                        <div class="space-y-6">
                            @if(isset($game['genres']) && count($game['genres']) > 0)
                                <div>
                                    <h2 class="text-xl font-semibold text-gray-200 mb-3">Genres</h2>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($game['genres'] as $genre)
                                            <span class="px-3 py-1 bg-indigo-500/20 text-indigo-400 rounded-full text-sm">
                                                {{ $genre['name'] }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            @if(isset($game['developers']) && count($game['developers']) > 0)
                                <div>
                                    <h2 class="text-xl font-semibold text-gray-200 mb-3">Developers</h2>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($game['developers'] as $developer)
                                            <span class="px-3 py-1 bg-gray-700/50 text-gray-300 rounded-full text-sm">
                                                {{ $developer['name'] }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            @if(isset($game['publishers']) && count($game['publishers']) > 0)
                                <div>
                                    <h2 class="text-xl font-semibold text-gray-200 mb-3">Publishers</h2>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($game['publishers'] as $publisher)
                                            <span class="px-3 py-1 bg-gray-700/50 text-gray-300 rounded-full text-sm">
                                                {{ $publisher['name'] }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            @if(isset($game['website']))
                                <div>
                                    <h2 class="text-xl font-semibold text-gray-200 mb-3">Official Website</h2>
                                    <a href="{{ $game['website'] }}" 
                                       target="_blank" 
                                       class="inline-flex items-center text-indigo-400 hover:text-indigo-300 transition-colors duration-200">
                                        <i class="fas fa-external-link-alt mr-2"></i>
                                        Visit Website
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
