<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Leaderboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Points Leaderboard -->
                <div class="bg-gray-800/50 backdrop-blur-lg overflow-hidden shadow-xl sm:rounded-lg border border-gray-700/50">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4 text-gray-200">Points Leaderboard</h3>
                        
                        <!-- Top 10 -->
                        <div class="space-y-2">
                            @foreach($pointsLeaderboard as $index => $user)
                                <div class="flex items-center justify-between p-3 {{ $index < 3 ? 'bg-gradient-to-r from-yellow-500/10 to-yellow-600/10' : 'bg-gray-700/30' }} rounded-lg hover:bg-gray-700/50 transition-all duration-200">
                                    <div class="flex items-center space-x-3">
                                        @if($index < 3)
                                            <span class="text-yellow-500">
                                                <i class="fas fa-trophy"></i>
                                            </span>
                                        @endif
                                        <span class="font-medium text-gray-200">{{ $user->nickname }}</span>
                                    </div>
                                    <span class="text-gray-300">{{ number_format($user->points) }} points</span>
                                </div>
                            @endforeach
                        </div>

                        <!-- User's Position -->
                        @if($userPointsRank > 10)
                            <div class="mt-4 pt-4 border-t border-gray-700/50">
                                <div class="flex items-center justify-between p-3 bg-indigo-500/10 rounded-lg">
                                    <div class="flex items-center space-x-3">
                                        <span class="text-indigo-400">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        <span class="font-medium text-gray-200">Your Position</span>
                                    </div>
                                    <span class="text-gray-300">#{{ $userPointsRank }} ({{ number_format(auth()->user()->points) }} points)</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Hours Leaderboard -->
                <div class="bg-gray-800/50 backdrop-blur-lg overflow-hidden shadow-xl sm:rounded-lg border border-gray-700/50">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4 text-gray-200">Hours Played Leaderboard</h3>
                        
                        <!-- Top 10 -->
                        <div class="space-y-2">
                            @foreach($hoursLeaderboard as $index => $user)
                                <div class="flex items-center justify-between p-3 {{ $index < 3 ? 'bg-gradient-to-r from-yellow-500/10 to-yellow-600/10' : 'bg-gray-700/30' }} rounded-lg hover:bg-gray-700/50 transition-all duration-200">
                                    <div class="flex items-center space-x-3">
                                        @if($index < 3)
                                            <span class="text-yellow-500">
                                                <i class="fas fa-trophy"></i>
                                            </span>
                                        @endif
                                        <span class="font-medium text-gray-200">{{ $user->nickname }}</span>
                                    </div>
                                    <span class="text-gray-300">{{ number_format($user->total_hours, 1) }} hours</span>
                                </div>
                            @endforeach
                        </div>

                        <!-- User's Position -->
                        @if($userHoursRank > 10)
                            <div class="mt-4 pt-4 border-t border-gray-700/50">
                                <div class="flex items-center justify-between p-3 bg-indigo-500/10 rounded-lg">
                                    <div class="flex items-center space-x-3">
                                        <span class="text-indigo-400">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        <span class="font-medium text-gray-200">Your Position</span>
                                    </div>
                                    <span class="text-gray-300">#{{ $userHoursRank }} ({{ number_format($userTotalHours, 1) }} hours)</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 