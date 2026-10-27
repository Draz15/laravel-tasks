@extends('layout.basic')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-50 px-4">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-1 text-center">Welcome Back</h2>
            <p class="text-sm text-gray-400 mb-6 text-center">Log in to your account</p>

            @if (session('error'))
                <div class="mb-4 text-sm text-red-600 bg-red-50 border border-red-100 rounded-xl px-4 py-2.5">
                    {{ session('error') }}
                </div>
            @endif

            <form action="/login" method="POST" class="flex flex-col gap-5">
                @csrf

                <div class="flex flex-col gap-1.5">
                    <label for="email" class="text-sm font-medium text-gray-600">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        placeholder="name@example.com"
                        class="border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700
                               focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-purple-400 transition">
                    @error('email')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col gap-1.5">
                    <label for="password" class="text-sm font-medium text-gray-600">Password</label>
                    <input type="password" id="password" name="password" placeholder="••••••••"
                        class="border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700
                               focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-purple-400 transition">
                    @error('password')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit"
                    class="bg-purple-600 hover:bg-purple-700 text-white font-medium py-2.5 rounded-xl text-sm transition">
                    Log In
                </button>
                <a href="/register" class="text-center text-sm text-gray-600">
                    Don't have an account? <span class="font-medium text-purple-600">Register</span>
                </a>
            </form>
        </div>
    </div>
@endsection
