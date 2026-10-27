@extends('layout.basic')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-50 px-4">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-1 text-center">Create Account</h2>
            <p class="text-sm text-gray-400 mb-6 text-center">Sign up to get started</p>

            <form action="/register" method="POST" class="flex flex-col gap-5">
                @csrf

                <div class="flex flex-col gap-1.5">
                    <label for="name" class="text-sm font-medium text-gray-600">Full name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        placeholder="Enter your name"
                        class="border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700
                               focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-purple-400 transition">
                    @error('name')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

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

                <div class="flex flex-col gap-1.5">
                    <label for="password_confirmation" class="text-sm font-medium text-gray-600">Confirm password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        placeholder="••••••••"
                        class="border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700
                               focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-purple-400 transition">
                </div>

                <button type="submit"
                    class="bg-purple-600 hover:bg-purple-700 text-white font-medium py-2.5 rounded-xl text-sm transition">
                    Register
                </button>

                <p class="text-sm text-gray-500 text-center">
                    Already have an account?
                    <a href="/login" class="text-purple-600 font-medium hover:underline">Log in</a>
                </p>
            </form>
        </div>
    </div>
@endsection