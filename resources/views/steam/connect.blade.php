@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="text-center">
                    <h2 class="text-3xl font-bold text-gray-900 mb-8">Connect Your Steam Account</h2>
                    
                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <div class="max-w-md mx-auto">
                        <div class="bg-gray-50 rounded-lg p-6 mb-6">
                            <div class="text-center mb-6">
                                <i class="fab fa-steam text-6xl text-[#171a21] mb-4"></i>
                                <h3 class="text-xl font-semibold text-gray-900">Why Connect Steam?</h3>
                                <p class="text-gray-600 mt-2">
                                    Connect your Steam account to track your achievements, game progress, and earn rewards!
                                </p>
                            </div>

                            <ul class="space-y-3 mb-6">
                                <li class="flex items-center text-gray-700">
                                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                    Track your game achievements
                                </li>
                                <li class="flex items-center text-gray-700">
                                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                    Sync your game library
                                </li>
                                <li class="flex items-center text-gray-700">
                                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                    Earn rewards and badges
                                </li>
                            </ul>

                            <a href="{{ route('steam.redirect') }}" 
                               class="w-full flex items-center justify-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-white bg-[#171a21] hover:bg-[#2a475e] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#171a21]">
                                <i class="fab fa-steam mr-2"></i>
                                Connect with Steam
                            </a>
                        </div>

                        <p class="text-sm text-gray-500 text-center">
                            By connecting your Steam account, you agree to our 
                            <a href="#" class="text-[#171a21] hover:underline">Terms of Service</a> 
                            and <a href="#" class="text-[#171a21] hover:underline">Privacy Policy</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 