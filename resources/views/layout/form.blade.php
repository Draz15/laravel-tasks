<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Movio Admin</title>
</head>

<body class="bg-gray-50">

    {{-- Sidebar --}}
    <aside class="fixed top-0 left-0 w-[18%] h-screen bg-white shadow-xl flex flex-col p-5 z-20">

        {{-- Logo --}}
        <div class="flex items-center gap-3 mb-10 px-1">
            <div
                class="w-10 h-10 rounded-xl bg-purple-600 flex items-center justify-center text-white font-bold text-lg">
                M
            </div>
            <h2 class="text-2xl font-bold font-['Faustina'] text-gray-800">Movio</h2>
        </div>

        {{-- Nav links --}}
        <ul class="flex flex-col gap-2 text-gray-600 font-medium">
            <li>
                <a href="/users"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                           {{ request()->is('users*') ? 'bg-purple-600 text-white shadow-md' : 'hover:bg-purple-50 hover:text-purple-700' }}">
                    <span>Users</span>
                </a>
            </li>
            <li>
                <a href="/movies"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                           {{ request()->is('movies*') ? 'bg-purple-600 text-white shadow-md' : 'hover:bg-purple-50 hover:text-purple-700' }}">
                    <span>Movies</span>
                </a>
            </li>
        </ul>

        {{-- User profile pinned to bottom --}}
        <div class="mt-auto flex items-center gap-3 pt-6 border-t border-gray-100">
            <div
                class="w-12 h-12 rounded-full bg-purple-100 border-2 border-purple-600 flex items-center justify-center text-purple-700 font-bold">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div class="flex flex-col">
                <p class="font-bold text-gray-800 leading-tight">{{ auth()->user()->name }}</p>
                <p class="text-sm text-gray-400">{{ auth()->user()->role == 1 ? 'Admin' : 'User' }}</p>
            </div>
        </div>
    </aside>

    {{-- Main content area --}}
    <div class="ml-[18%] min-h-screen">

        {{-- Navbar --}}
        <nav class="h-20 px-8 flex items-center justify-between bg-white border-b border-gray-100 sticky top-0 z-10">
            <h3 class="font-bold text-2xl font-['Faustina'] text-gray-800">
                Good Morning, {{ Auth::user()->name }} 👋
            </h3>

            <div class="relative w-[35%]">
                <input type="text"
                    class="w-full pl-4 pr-4 py-2.5 rounded-xl border border-gray-200 outline-none
                           focus:ring-2 focus:ring-purple-400 focus:border-purple-400 transition text-sm"
                    placeholder="Search...">
            </div>

            <form action="/logout" method="POST">
                @csrf
                <button type="submit"
                    class="bg-white border border-gray-200 hover:border-red-300 hover:text-red-600 text-gray-600 px-5 py-2.5 rounded-xl text-sm font-medium transition">
                    Logout
                </button>
            </form>
        </nav>

        {{-- Page content --}}
        <div class="p-8">
            @yield('content')
        </div>
    </div>

</body>

</html>
