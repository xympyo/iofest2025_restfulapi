@extends('layouts.app')

@section('title', 'TappyTale Forge')

@section('content')
    <div class="min-h-screen bg-[#f8f9fa] flex flex-col">
        <!-- Navbar -->
        <nav class="flex justify-between items-center px-6 py-4 bg-transparent">
            <div class="flex items-center">
                <img src="{{ asset('logo.png') }}" alt="TappyTale Forge Logo" class="h-7 mr-2">
                <a href="{{ url('index') }}">
                    <span class="text-xl font-bold text-[#F8B6B6]">TappyTale</span><span
                        class="text-xl font-bold text-white ml-1">Forge</span>
                </a>
            </div>
            <div class="flex items-center gap-6">
                <a href="#get-premium" class="font-semibold text-[#30313E] hover:text-[#F8B6B6] transition">Get Premium</a>
                <a href="{{ route('login') }}"
                    class="font-semibold text-[#30313E] hover:text-[#F8B6B6] transition">Login</a>
            </div>
        </nav>
        <!-- Hero Section -->
        <section class="flex flex-col items-center justify-center py-10 px-4">
            <h1 class="text-4xl font-extrabold text-[#F8B6B6] mb-2 text-center">TappyTale <span
                    class="text-[#30313E]">Forge</span></h1>
            <p class="text-lg text-[#30313E] mb-6 text-center">Create your own story book today.</p>
            <div class="flex flex-col items-center gap-3 w-full max-w-xs mx-auto">
                <a href="#get-premium"
                    class="px-6 py-2 rounded-lg bg-[#bdb6e6] text-white font-semibold text-lg shadow-lg hover:-translate-y-1 hover:shadow-2xl hover:ring-4 hover:ring-[#c3b9e6]/40 transition text-center">Try
                    Premium</a>
                <span class="text-white font-semibold">or</span>
                <a href="#create-storybook"
                    class="px-6 py-2 rounded-lg bg-[#bdb6e6] text-white font-semibold text-lg shadow-lg hover:-translate-y-1 hover:shadow-2xl hover:ring-4 hover:ring-[#c3b9e6]/40 transition text-center">Create
                    your own Storybook</a>
            </div>
        </section>
        <!-- Get Coins Section -->
        <section id="get-coins" class="mt-8 px-4">
            <h2 class="text-2xl font-bold text-[#30313E] text-center mb-2">Get Coins</h2>
            <p class="text-center text-[#30313E] mb-8">Support your favorite creator, now!</p>
            <div class="grid grid-cols-12 gap-4 mx-auto mb-6">
                <div class="col-span-2"></div>
                <div
                    class="col-span-2 bg-[#bdb6e6] rounded-xl p-4 shadow-lg transition hover:-translate-y-2 hover:shadow-2xl hover:ring-4 hover:ring-[#c3b9e6]/40 cursor-pointer text-white text-center font-medium">
                    Get early access on your favorite storybook!</div>
                <div
                    class="col-span-2 bg-[#bdb6e6] rounded-xl p-4 shadow-lg transition hover:-translate-y-2 hover:shadow-2xl hover:ring-4 hover:ring-[#c3b9e6]/40 cursor-pointer text-white text-center font-medium">
                    Get access to premium storybook that takes creator extra time!</div>
                <div
                    class="col-span-2 bg-[#bdb6e6] rounded-xl p-4 shadow-lg transition hover:-translate-y-2 hover:shadow-2xl hover:ring-4 hover:ring-[#c3b9e6]/40 cursor-pointer text-white text-center font-medium">
                    Support your favorite creator by getting their storybook early!</div>
                <div
                    class="col-span-2 bg-[#bdb6e6] rounded-xl p-4 shadow-lg transition hover:-translate-y-2 hover:shadow-2xl hover:ring-4 hover:ring-[#c3b9e6]/40 cursor-pointer text-white text-center font-medium">
                    Or, just buy Premium! Get daily early access storybook and daily coins!</div>
                <div class="col-span-2"></div>
            </div>
            <div class="grid grid-cols-12 items-center justify-center gap-4">
                <div class="col-span-2"></div>
                <div class="col-span-8 bg-[#bdb6e6] rounded-xl p-4 shadow-lg flex-1 mb-2 md:mb-0">
                    <div class="position-relative justify-between flex flex-row align-middle py-2">
                        <p class="text-white font-medium">
                            Check out
                            our package<br><span class="text-sm text-white">Gain access to early access story, and premium
                                storybook!</span>
                        </p>
                        <a href="#buy-coin"
                            class="py-2 px-6 rounded-lg bg-white text-[#30313E] font-semibold shadow-lg hover:-translate-y-1 hover:shadow-lg hover:ring-4 hover:ring-[#c3b9e6]/40 transition">Buy
                            Coin</a>
                    </div>
                </div>
                <div class="col-span-2"></div>
            </div>
        </section>
        <!-- Get Premium Section -->
        <section id="get-premium" class="mt-16 px-4 mb-10">
            <h2 class="text-2xl font-bold text-[#30313E] text-center mb-2">Get Premium</h2>
            <p class="text-center text-[#30313E] mb-8">enjoy monthly coins and access to premium storybook</p>
            <div class="grid grid-cols-12 gap-6 mx-auto mb-6">
                <div class=" col-span-2"></div>
                <div
                    class="col-span-2 bg-[#bdb6e6] rounded-xl p-4 shadow-lg transition hover:-translate-y-2 hover:shadow-2xl hover:ring-4 hover:ring-[#c3b9e6]/40 cursor-pointer text-white text-center font-medium">
                    Get coins each month to access your favorite early access storybook!</div>
                <div class="col-span-1"></div>
                <div
                    class="col-span-2 bg-[#bdb6e6] rounded-xl p-4 shadow-lg transition hover:-translate-y-2 hover:shadow-2xl hover:ring-4 hover:ring-[#c3b9e6]/40 cursor-pointer text-white text-center font-medium">
                    Get limited free access everyday to your favorite premium storybook!</div>
                <div class="col-span-1"></div>
                <div
                    class="col-span-2 bg-[#bdb6e6] rounded-xl p-4 shadow-lg transition hover:-translate-y-2 hover:shadow-2xl hover:ring-4 hover:ring-[#c3b9e6]/40 cursor-pointer text-white text-center font-medium">
                    Get the full experience access without ads, at all!</div>
                <div class="col-span-2"></div>
            </div>
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-5"></div>
                <a href="#get-premium-action"
                    class="col-span-2 py-2 px-8 rounded-lg bg-[#bdb6e6] text-white text-center font-semibold shadow-lg hover:-translate-y-1 hover:shadow-2xl hover:ring-4 hover:ring-[#c3b9e6]/40 transition">Get
                    Premium</a>
                <div class="col-span-5"></div>
            </div>
        </section>
        <!-- Footer -->
        <footer class="mt-auto py-4 text-center text-xs text-[#30313E]">
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
