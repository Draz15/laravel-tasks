@extends('layout.form')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-semibold text-gray-700">Movies</h2>
        <a href="/movies/add"
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
                <tr class="hover:bg-purple-50 transition-colors">
                    <td class="px-6 py-4 font-medium text-gray-700">
                        <img src="/images/movies/{{ $Movie->poster }}" class="w-16 rounded-md" alt="">
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-700">
                        {{ $Movie->title }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-purple-100 text-purple-700">
                            {{ $Movie->type }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm font-semibold text-gray-700">
                        {{ $Movie->release_year }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="flex items-center gap-1 text-sm font-semibold text-gray-700">
                            ⭐ {{ $Movie->rating }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">
                        {{ $Movie->description }}
                    </td>
                    <td class="px-6 py-4">

                        <a href="/movies/{{ $Movie->id }}/edit"
                            class="px-3 py-1.5 rounded-lg bg-sky-50 text-sky-700 hover:bg-sky-100 text-sm font-medium transition">
                            Update
                        </a>
                        <form action="/movies/{{ $Movie->id }}" method="POST" class="inline">
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

    </tbody>
    </table>
    </div>
@endsection
