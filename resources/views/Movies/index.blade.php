@extends('layout.form')

@section('content')

    <div class="flex items-center justify-between mb-6">
        <h2 class="text-4xl font-bold text-gray-700">Movies</h2>
        <a href="/movies/create"
            class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-2.5 rounded-xl text-sm font-medium transition">
            + Add Movie
        </a>
    </div>

    <div class="w-full bg-white rounded-2xl shadow-lg overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-500 text-sm uppercase tracking-wide">
                    <th class="px-6 py-4 font-medium">Poster</th>
                    <th class="px-6 py-4 font-medium">Title</th>
                    <th class="px-6 py-4 font-medium">Type</th>
                    <th class="px-6 py-4 font-medium">Year</th>
                    <th class="px-6 py-4 font-medium">Rating</th>
                    <th class="px-6 py-4 font-medium">Description</th>
                    <th class="px-6 py-4 font-medium text-center">Operation</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">
                @forelse ($result as $item)
                    <tr class="hover:bg-purple-50 transition-colors">
                        <td class="px-6 py-4 font-medium text-gray-700">
                            <img src="/images/movies/{{ $item->poster }}" class="w-16 rounded-md" alt="">
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-700">
                            {{ $item->title }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-purple-100 text-purple-700">
                                {{ $item->type }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm font-semibold text-gray-700">
                            {{ $item->release_year }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="flex items-center gap-1 text-sm font-semibold text-gray-700">
                                ⭐ {{ $item->rating }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">
                            {{ $item->description }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <a href="/movies/{{ $item->id }}"
                                    class="px-3 py-1.5 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 text-sm font-medium transition">
                                    Show
                                </a>
                                <a href="/movies/{{ $item->id }}/edit"
                                    class="px-3 py-1.5 rounded-lg bg-sky-50 text-sky-700 hover:bg-sky-100 text-sm font-medium transition">
                                    Update
                                </a>
                                <form action="/movies/{{ $item->id }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-1.5 rounded-lg bg-red-50 text-red-700 hover:bg-red-100 text-sm font-medium transition">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-gray-400">
                            No movies found. Click "+ Add Movie" to create one.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection