@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="min-h-screen flex flex-col lg:flex-row">
        <!-- Left Card Section -->
        <div
            class="lg:w-1/2 flex flex-col items-center justify-center bg-gradient-to-b from-[#e6e6f7] to-[#57576d] relative">
            <div class="flex flex-col items-center mt-16 lg:mt-0">
                <div class="flex items-center mb-10">
                    <img src="{{ asset('logo.png') }}" alt="TappyTale Forge Logo" class="h-8 mr-2">
                    <span class="text-2xl font-bold text-[#F8B6B6]">TappyTale</span><span
                        class="text-2xl font-bold text-[#23232B] ml-1">Forge</span>
                </div>
                <div class="font-bold text-2xl text-[#23232B] mb-2 text-center drop-shadow">Start creating<br>magical
                    stories.</div>
                <!-- Animated Cards -->
                <div class="relative h-44 w-52 mt-8 flex items-center justify-center">
                    <div class="absolute -rotate-5 left-4 z-1 top-10 animate-floating-card transition-transform duration-500 hover:-translate-y-4 hover:shadow-2xl hover:shadow-[#c3b9e6]/60 hover:ring-4 hover:ring-[#c3b9e6]/40 shadow-lg shadow-[#23232B]/30 rounded-xl bg-[#bdb6e6] w-24 h-32 flex items-center justify-center group/card1 cursor-pointer"
                        style="box-shadow:0 18px 30px 0 #23232b44;">
                        <svg width="48" height="48" fill="none" viewBox="0 0 24 24">
                            <rect width="48" height="48" rx="10" fill="#e1e1fa" />
                            <path d="M24 24L12 12" stroke="#a3a3c2" stroke-width="2" />
                        </svg>
                    </div>
                    <div class="absolute rotate-5 right-4 z-2 top-0 animate-floating-card2 transition-transform duration-500 hover:-translate-y-5 hover:shadow-2xl hover:shadow-[#c3b9e6]/60 hover:ring-4 hover:ring-[#c3b9e6]/40 shadow-lg shadow-[#23232B]/30 rounded-xl bg-[#e1e1fa] w-28 h-36 flex items-center justify-center group/card2 cursor-pointer"
                        style="box-shadow:0 24px 40px 0 #23232b33;">
                        <svg width="60" height="60" fill="none" viewBox="0 0 24 24">
                            <rect width="60" height="60" rx="12" fill="#bdb6e6" />
                            <path d="M12 8v4l3 3" stroke="#a3a3c2" stroke-width="2" />
                        </svg>
                    </div>
                </div>
                <style>
                    @keyframes floating-card {

                        0%,
                        100% {
                            transform: translateY(0);
                            box-shadow: 0 18px 30px 0 #23232b44;
                        }

                        50% {
                            transform: translateY(-18px);
                            box-shadow: 0 36px 50px 0 #23232b22;
                        }
                    }

                    @keyframes floating-card2 {

                        0%,
                        100% {
                            transform: translateY(0);
                            box-shadow: 0 24px 40px 0 #23232b33;
                        }

                        50% {
                            transform: translateY(-24px);
                            box-shadow: 0 48px 80px 0 #23232b11;
                        }
                    }

                    .animate-floating-card {
                        animation: floating-card 3s ease-in-out infinite;
                    }

                    .animate-floating-card2 {
                        animation: floating-card2 4s ease-in-out infinite;
                    }

                    .group\/card1:hover,
                    .group\/card2:hover {
                        box-shadow: 0 42px 80px 0 #c3b9e6;
                        filter: brightness(1.2) drop-shadow(0 0 16px #c3b9e6);
                    }
                </style>
            </div>
        </div>
        <!-- Right Form Section -->
        <div class="lg:w-1/2 flex flex-col justify-center items-center bg-white dark:bg-[#f8f9fa] p-8">
            <div class="w-full max-w-md">
                <h2 class="text-2xl font-bold mb-2 text-[#23232B] text-center">Welcome Back!</h2>
                <div class="text-center text-[#23232B] mb-6">
                    Don’t have an account? <a href="#" class="underline text-[#23232B] hover:text-[#F8B6B6]">Create
                        one in your TappyTale Application!</a><br>
                    <span class="text-sm text-[#23232B]">It’s FREE! Takes less than a minute.</span>
                </div>
                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label for="email" class="block text-[#23232B] font-semibold">Email</label>
                        <input id="email" name="email" type="email" required
                            class="w-full border-b-2 border-[#23232B] bg-transparent py-2 px-1 focus:outline-none focus:border-[#F8B6B6] transition placeholder:text-gray-400"
                            placeholder="Enter your email">
                    </div>
                    <div>
                        <label for="password" class="block text-[#23232B] font-semibold">Password</label>
                        <input id="password" name="password" type="password" required
                            class="w-full border-b-2 border-[#23232B] bg-transparent py-2 px-1 focus:outline-none focus:border-[#F8B6B6] transition placeholder:text-gray-400"
                            placeholder="Enter your password">
                    </div>
                    <button type="submit"
                        class="w-full py-3 bg-[#23232B] text-white rounded-lg font-semibold text-lg hover:bg-[#F8B6B6] hover:text-[#23232B] transition">Login
                        Now</button>
                    <button type="button"
                        class="w-full py-3 border border-gray-300 rounded-lg flex items-center justify-center gap-2 text-[#23232B] font-semibold text-lg bg-white hover:bg-gray-100 transition">
                        <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" class="w-6 h-6">
                        Login with Google
                    </button>
                </form>
                <div class="text-right mt-4">
                    <span class="text-[#bdb6e6]">Forget password?</span>
                    <a href="{{ url('forgot_password') }}" class="text-[#23232B] underline hover:text-[#F8B6B6]">Click
                        here</a>
                </div>
            </div>
        </div>
    </div>
@endsection
