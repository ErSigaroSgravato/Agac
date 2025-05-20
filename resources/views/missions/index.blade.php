<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Missions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800/50 backdrop-blur-lg overflow-hidden shadow-xl sm:rounded-lg border border-gray-700/50">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($missions as $mission)
                            <div class="bg-gray-700/30 rounded-lg p-6 hover:bg-gray-700/50 transition-all duration-200">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-lg font-semibold text-gray-200">{{ $mission->title }}</h3>
                                    <span class="px-3 py-1 rounded-full text-sm font-medium {{ $mission->is_completed ? 'bg-green-500/20 text-green-400' : 'bg-yellow-500/20 text-yellow-400' }}">
                                        {{ $mission->is_completed ? 'Completed' : 'In Progress' }}
                                    </span>
                                </div>
                                
                                <p class="text-gray-300 mb-4">{{ $mission->description }}</p>
                                
                                <div class="space-y-2">
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-gray-400">Progress</span>
                                        <span class="text-gray-300">{{ $mission->progress }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-600/30 rounded-full h-2">
                                        <div class="bg-gradient-to-r from-blue-500 to-indigo-500 h-2 rounded-full" style="width: {{ $mission->progress }}%"></div>
                                    </div>
                                </div>

                                <div class="mt-4 pt-4 border-t border-gray-700/50">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-2">
                                            <i class="fas fa-trophy text-yellow-500"></i>
                                            <span class="text-gray-300">{{ number_format($mission->points) }} points</span>
                                        </div>
                                        @if($mission->is_completed)
                                            <span class="text-green-400">
                                                <i class="fas fa-check-circle"></i>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 