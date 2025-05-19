@extends('layouts.app')

@section('title', 'TappyTale Forge')

@section('content')
    <div class="min-h-screen bg-[#f8f9fa] flex flex-col">
        <!-- Navbar -->
        <nav class="flex justify-between items-center px-6 py-4 bg-transparent">
            <div class="flex items-center">
                <img src="/images/logo.svg" alt="TappyTale Forge Logo" class="h-7 mr-2">
                <a href="{{ url('index') }}">
                    <span class="text-xl font-bold text-[#F8B6B6]">TappyTale</span><span
                        class="text-xl font-bold text-[#23232B] ml-1">Forge</span>
                </a>
            </div>
            <div class="flex items-center gap-6">
                <a href="#get-premium" class="font-semibold text-[#23232B] hover:text-[#F8B6B6] transition">Get Premium</a>
                <a href="{{ route('login') }}" class="font-semibold text-[#23232B] hover:text-[#F8B6B6] transition">Login</a>
            </div>
        </nav>
        <!-- Hero Section -->
        <section class="flex flex-col items-center justify-center py-10 px-4">
            <h1 class="text-4xl font-extrabold text-[#F8B6B6] mb-2 text-center">TappyTale <span
                    class="text-[#23232B]">Forge</span></h1>
            <p class="text-lg text-[#23232B] mb-6 text-center">Create your own story book today.</p>
            <div class="flex flex-col items-center gap-3 w-full max-w-xs mx-auto">
                <a href="#get-premium"
                    class="w-full py-2 rounded-lg bg-[#bdb6e6] text-[#23232B] font-semibold text-lg shadow-lg hover:-translate-y-1 hover:shadow-2xl hover:ring-4 hover:ring-[#c3b9e6]/40 transition text-center">Try
                    Premium</a>
                <span class="text-[#23232B] font-semibold">or</span>
                <a href="#create-storybook"
                    class="w-full py-2 rounded-lg bg-[#bdb6e6] text-[#23232B] font-semibold text-lg shadow-lg hover:-translate-y-1 hover:shadow-2xl hover:ring-4 hover:ring-[#c3b9e6]/40 transition text-center">Create
                    your own Storybook</a>
            </div>
        </section>
        <!-- Get Coins Section -->
        <section id="get-coins" class="mt-8 px-4">
            <h2 class="text-2xl font-bold text-[#23232B] text-center mb-2">Get Coins</h2>
            <p class="text-center text-[#23232B] mb-8">Support your favorite creator, now!</p>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 max-w-5xl mx-auto mb-6">
                <div
                    class="bg-[#bdb6e6] rounded-xl p-4 shadow-lg transition hover:-translate-y-2 hover:shadow-2xl hover:ring-4 hover:ring-[#c3b9e6]/40 cursor-pointer text-[#23232B] text-center font-medium">
                    Get early access on your favorite storybook!</div>
                <div
                    class="bg-[#bdb6e6] rounded-xl p-4 shadow-lg transition hover:-translate-y-2 hover:shadow-2xl hover:ring-4 hover:ring-[#c3b9e6]/40 cursor-pointer text-[#23232B] text-center font-medium">
                    Get access to premium storybook that takes creator extra time!</div>
                <div
                    class="bg-[#bdb6e6] rounded-xl p-4 shadow-lg transition hover:-translate-y-2 hover:shadow-2xl hover:ring-4 hover:ring-[#c3b9e6]/40 cursor-pointer text-[#23232B] text-center font-medium">
                    Support your favorite creator by getting their storybook early!</div>
                <div
                    class="bg-[#bdb6e6] rounded-xl p-4 shadow-lg transition hover:-translate-y-2 hover:shadow-2xl hover:ring-4 hover:ring-[#c3b9e6]/40 cursor-pointer text-[#23232B] text-center font-medium">
                    Or, just buy Premium! Get daily early access storybook and daily coins!</div>
            </div>
            <div class="flex flex-col md:flex-row items-center justify-center gap-4 max-w-3xl mx-auto">
                <div class="bg-[#bdb6e6] rounded-xl p-4 shadow-lg flex-1 text-[#23232B] font-medium mb-2 md:mb-0">Check out
                    our package<br><span class="text-sm text-[#23232B]">Gain access to early access story, and premium
                        storybook!</span></div>
                <a href="#buy-coin"
                    class="py-2 px-6 rounded-lg bg-[#bdb6e6] text-[#23232B] font-semibold shadow-lg hover:-translate-y-1 hover:shadow-2xl hover:ring-4 hover:ring-[#c3b9e6]/40 transition">Buy
                    Coin</a>
            </div>
        </section>
        <!-- Get Premium Section -->
        <section id="get-premium" class="mt-16 px-4 mb-10">
            <h2 class="text-2xl font-bold text-[#23232B] text-center mb-2">Get Premium</h2>
            <p class="text-center text-[#23232B] mb-8">enjoy monthly coins and access to premium storybook</p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto mb-6">
                <div
                    class="bg-[#bdb6e6] rounded-xl p-4 shadow-lg transition hover:-translate-y-2 hover:shadow-2xl hover:ring-4 hover:ring-[#c3b9e6]/40 cursor-pointer text-[#23232B] text-center font-medium">
                    Get coins each month to access your favorite early access storybook!</div>
                <div
                    class="bg-[#bdb6e6] rounded-xl p-4 shadow-lg transition hover:-translate-y-2 hover:shadow-2xl hover:ring-4 hover:ring-[#c3b9e6]/40 cursor-pointer text-[#23232B] text-center font-medium">
                    Get limited free access everyday to your favorite premium storybook!</div>
                <div
                    class="bg-[#bdb6e6] rounded-xl p-4 shadow-lg transition hover:-translate-y-2 hover:shadow-2xl hover:ring-4 hover:ring-[#c3b9e6]/40 cursor-pointer text-[#23232B] text-center font-medium">
                    Get the full experience access without ads, at all!</div>
            </div>
            <div class="flex justify-center">
                <a href="#get-premium-action"
                    class="py-2 px-8 rounded-lg bg-[#bdb6e6] text-[#23232B] font-semibold shadow-lg hover:-translate-y-1 hover:shadow-2xl hover:ring-4 hover:ring-[#c3b9e6]/40 transition">Get
                    Premium</a>
            </div>
        </section>
        <!-- Footer -->
        <footer class="mt-auto py-4 text-center text-xs text-[#23232B]">
            TappyTale - Bocil Kehidupan - President University
        </footer>
        <style>
            /* Card floating/hover animation similar to login page */
            .hover\:-translate-y-2:hover {
                transform: translateY(-8px) !important;
            }

            .hover\:shadow-2xl:hover {
                box-shadow: 0 24px 40px 0 #c3b9e6 !important;
            }

            .hover\:ring-4:hover {
                box-shadow: 0 24px 40px 0 #c3b9e6, 0 0 0 4px #c3b9e6 !important;
            }
        </style>
    </div>
@endsection
