<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('My Gaming Stats') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Overview Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-gray-800/50 backdrop-blur-lg p-6 rounded-lg border border-gray-700/50">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-indigo-500/20">
                            <i class="fas fa-clock text-2xl text-indigo-400"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-400">Total Playtime</p>
                            <p class="text-2xl font-semibold text-gray-200">{{ number_format($totalHours) }}h</p>
                            <p class="text-sm text-gray-500">{{ number_format($recentHours) }}h in last 14 days</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-800/50 backdrop-blur-lg p-6 rounded-lg border border-gray-700/50">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-purple-500/20">
                            <i class="fas fa-trophy text-2xl text-purple-400"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-400">Achievements</p>
                            <p class="text-2xl font-semibold text-gray-200">{{ number_format($totalAchievements) }}</p>
                            <p class="text-sm text-gray-500">{{ number_format($recentAchievements) }} recently</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-800/50 backdrop-blur-lg p-6 rounded-lg border border-gray-700/50">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-500/20">
                            <i class="fas fa-gamepad text-2xl text-green-400"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-400">Games Played</p>
                            <p class="text-2xl font-semibold text-gray-200">{{ number_format($mostPlayedGames->count()) }}</p>
                            <p class="text-sm text-gray-500">Across all games</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Most Played Games -->
                <div class="bg-gray-800/50 backdrop-blur-lg p-6 rounded-lg border border-gray-700/50">
                    <h3 class="text-lg font-medium text-gray-200 mb-4">Most Played Games</h3>
                    <div class="space-y-4">
                        @foreach($mostPlayedGames as $game)
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm font-medium text-gray-300">{{ $game->name }}</span>
                                    <span class="text-sm font-medium text-gray-400">{{ number_format($game->total_hours) }}h</span>
                                </div>
                                <div class="w-full bg-gray-700/50 rounded-full h-2">
                                    <div class="bg-indigo-500 h-2 rounded-full" style="width: {{ ($game->total_hours / $mostPlayedGames->first()->total_hours) * 100 }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Recent Achievements -->
                <div class="bg-gray-800/50 backdrop-blur-lg p-6 rounded-lg border border-gray-700/50">
                    <h3 class="text-lg font-medium text-gray-200 mb-4">Recent Achievements</h3>
                    <div class="space-y-4">
                        @foreach($achievements->take(5) as $achievement)
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-lg bg-gray-700/50 flex items-center justify-center">
                                    <i class="fas fa-trophy text-yellow-400"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-200">{{ $achievement->name }}</p>
                                    <p class="text-xs text-gray-400">{{ $achievement->game->name }}</p>
                                </div>
                                <div class="ml-auto text-right">
                                    <p class="text-xs text-gray-500">{{ $achievement->achievement_user->completed_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Playtime Distribution -->
            <div class="bg-gray-800/50 backdrop-blur-lg p-6 rounded-lg border border-gray-700/50">
                <h3 class="text-lg font-medium text-gray-200 mb-4">Playtime Distribution by Day</h3>
                <div class="grid grid-cols-7 gap-4">
                    @php
                        $days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
                        $maxHours = $playtimeByDay->max('total_hours');
                    @endphp
                    @foreach($playtimeByDay as $day)
                        <div class="text-center">
                            <div class="h-32 flex items-end justify-center">
                                <div class="w-full bg-indigo-500/20 rounded-t-lg" style="height: {{ ($day->total_hours / $maxHours) * 100 }}%">
                                    <div class="bg-indigo-500 rounded-t-lg" style="height: 100%"></div>
                                </div>
                            </div>
                            <p class="text-sm text-gray-400 mt-2">{{ $days[$day->day - 1] }}</p>
                            <p class="text-xs text-gray-500">{{ number_format($day->total_hours) }}h</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-gray-800/50 backdrop-blur-lg p-6 rounded-lg border border-gray-700/50">
                <h3 class="text-lg font-medium text-gray-200 mb-4">Recent Activity</h3>
                <div class="space-y-4">
                    @foreach($recentActivity as $activity)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-lg bg-gray-700/50 flex items-center justify-center">
                                    <i class="fas fa-gamepad text-gray-400"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-200">{{ $activity->game->name }}</p>
                                    <p class="text-xs text-gray-400">{{ $activity->created_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-200">{{ number_format($activity->playtime_forever) }}h</p>
                                <p class="text-xs text-gray-400">{{ $activity->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Add any JavaScript for interactive charts here
    </script>
    @endpush
</x-app-layout> 