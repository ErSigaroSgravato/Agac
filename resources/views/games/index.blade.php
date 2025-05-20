<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-200 leading-tight">
                {{ $isMyGames ? 'My Games' : 'Games' }}
            </h2>
            <a href="{{ $isMyGames ? route('browse-games') : route('my-games') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-700/50 border border-gray-600 rounded-lg font-semibold text-sm text-gray-200 hover:bg-gray-700 transition-all duration-200">
                {{ $isMyGames ? 'Browse Games' : 'My Games' }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(!$isMyGames)
                <div class="mb-6">
                    <form action="{{ route('browse-games') }}" method="GET" class="flex gap-4">
                        <div class="flex-1">
                            <input type="text" 
                                   name="search" 
                                   value="{{ request('search') }}" 
                                   placeholder="Search games..." 
                                   class="w-full px-4 py-2 bg-gray-700/50 border border-gray-600 rounded-lg text-gray-200 placeholder-gray-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                        </div>
                        <button type="submit" 
                                class="px-6 py-2 bg-indigo-600 border border-indigo-500 rounded-lg font-semibold text-sm text-white hover:bg-indigo-500 transition-all duration-200">
                            Search
                        </button>
                    </form>
                </div>
            @endif

            @if($games->isEmpty())
                <div class="bg-gray-800/50 backdrop-blur-lg overflow-hidden shadow-xl sm:rounded-lg border border-gray-700/50">
                    <div class="p-6 text-center">
                        <div class="text-gray-400 mb-4">
                            <i class="fas fa-gamepad text-4xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-200 mb-2">
                            {{ $isMyGames ? 'No Games Found' : 'No Games Match Your Search' }}
                        </h3>
                        <p class="text-gray-400">
                            {{ $isMyGames 
                                ? 'Connect your Steam account to see your games here.' 
                                : 'Try adjusting your search terms or browse our collection.' }}
                        </p>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($games as $game)
                        <div class="bg-gray-800/50 backdrop-blur-lg overflow-hidden shadow-xl sm:rounded-lg border border-gray-700/50 hover:bg-gray-700/50 transition-all duration-200 group">
                            <div class="aspect-w-16 aspect-h-9 relative">
                                <img src="{{ $game->image_url }}" 
                                     alt="{{ $game->name }}" 
                                     class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-300">
                                <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                                    <div class="p-4 w-full">
                                        <a href="{{ route('games.show', $game->rawg_id) }}" 
                                           class="inline-flex items-center px-3 py-1.5 bg-indigo-600/80 hover:bg-indigo-500 rounded-lg text-sm font-medium text-white transition-colors duration-200">
                                            <i class="fas fa-info-circle mr-1.5"></i>View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-200 mb-2 truncate">{{ $game->name }}</h3>
                                
                                @if($isMyGames && isset($game->playtimes))
                                    @php
                                        $playtime = $game->playtimes->first();
                                        $totalHours = round($playtime->playtime_forever / 60, 1);
                                        $recentHours = round($playtime->playtime_2weeks / 60, 1);
                                    @endphp
                                    <div class="space-y-2 mb-4">
                                        <div class="flex items-center justify-between text-sm">
                                            <span class="text-gray-400">Total Playtime</span>
                                            <span class="text-gray-300">{{ number_format($totalHours, 1) }} hours</span>
                                        </div>
                                        <div class="w-full bg-gray-600/30 rounded-full h-2">
                                            <div class="bg-gradient-to-r from-blue-500 to-indigo-500 h-2 rounded-full" 
                                                 style="width: {{ min(100, ($totalHours / 100) * 100) }}%"></div>
                                        </div>
                                        @if($recentHours > 0)
                                            <div class="flex items-center justify-between text-sm">
                                                <span class="text-gray-400">Last 2 weeks</span>
                                                <span class="text-gray-300">{{ number_format($recentHours, 1) }} hours</span>
                                            </div>
                                        @endif
                                    </div>
                                @endif

                                @if($game->rawg_data)
                                    @php
                                        $rawgData = is_string($game->rawg_data) ? json_decode($game->rawg_data, true) : $game->rawg_data;
                                    @endphp
                                    <div class="space-y-2">
                                        @if(isset($rawgData['released']))
                                            <div class="flex items-center justify-between text-sm">
                                                <span class="text-gray-400">Released</span>
                                                <span class="text-gray-300">{{ \Carbon\Carbon::parse($rawgData['released'])->format('M d, Y') }}</span>
                                            </div>
                                        @endif
                                        
                                        @if(isset($rawgData['rating']))
                                            <div class="flex items-center justify-between text-sm">
                                                <span class="text-gray-400">Rating</span>
                                                <div class="flex items-center">
                                                    <i class="fas fa-star text-yellow-500 mr-1"></i>
                                                    <span class="text-gray-300">{{ number_format($rawgData['rating'], 1) }}/5</span>
                                                </div>
                                            </div>
                                        @endif

                                        @if(isset($rawgData['genres']) && count($rawgData['genres']) > 0)
                                            <div class="flex flex-wrap gap-1 mt-2">
                                                @foreach(array_slice($rawgData['genres'], 0, 3) as $genre)
                                                    <span class="px-2 py-1 bg-indigo-500/20 text-indigo-400 rounded-full text-xs">
                                                        {{ $genre['name'] }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                @if(method_exists($games, 'hasPages') && $games->hasPages())
                    <div class="mt-6">
                        {{ $games->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>
</x-app-layout>
