@extends('layout.basic')


@section('content')
    {{-- Navbar --}}
    <nav class="flex items-center justify-between px-8 md:px-16 py-6">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-purple-600 flex items-center justify-center text-white font-bold text-lg">
                M
            </div>
            <h2 class="text-2xl font-bold font-['Faustina'] text-gray-800">Movio</h2>
        </div>

        <div class="flex items-center gap-4">
            @auth
                <span class="text-sm text-gray-500 hidden md:inline">
                    Hi, {{ auth()->user()->name }}
                </span>


                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit"
                        class="bg-white border border-gray-200 hover:border-red-300 hover:text-red-600 text-gray-600 px-5 py-2.5 rounded-xl text-sm font-medium transition">
                        Logout
                    </button>
                </form>
            @else
                <a href="/login"
                    class="text-gray-600 hover:text-purple-600 px-5 py-2.5 rounded-xl text-sm font-medium transition">
                    Login
                </a>
                <a href="/register"
                    class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-2.5 rounded-xl text-sm font-medium transition">
                    Register
                </a>
            @endauth
        </div>
    </nav>


    @include('components.chatbot')

    </div>
@endsection
