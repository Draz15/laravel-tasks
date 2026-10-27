@extends('layout.basic')

@section('content')
    <div class="min-h-screen flex items-center justify-center px-4 py-10">
        <div class="w-full max-w-2xl bg-white rounded-2xl shadow-xl p-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-1 text-center">Add Movie</h2>
            <p class="text-sm text-gray-400 mb-6 text-center">Add a new title to your catalog</p>

            <form action="/movies" method="POST" enctype="multipart/form-data" class="flex flex-col gap-5">
                @csrf

                {{-- Title --}}
                <div class="flex flex-col gap-1.5">
                    <label for="title" class="text-sm font-medium text-gray-600">Title</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}"
                        placeholder="Movie title"
                        class="border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700
                               focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-purple-400 transition">
                    @error('title')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex gap-4">
                    {{-- Year --}}
                    <div class="flex flex-col gap-1.5 flex-1">
                        <label for="release_year" class="text-sm font-medium text-gray-600">Year</label>
                        <input type="text" id="release_year" name="release_year" value="{{ old('release_year') }}"
                            placeholder="2024"
                            class="border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700
                                   focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-purple-400 transition">
                        @error('release_year')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Genre --}}
                    <div class="flex flex-col gap-1.5 flex-1">
                        <label for="type" class="text-sm font-medium text-gray-600">Genre</label>
                        <select id="type" name="type"
                            class="border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700 bg-white
                                   focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-purple-400 transition">
                            <option value="comedy" @selected(old('type') == 'comedy')>Comedy</option>
                            <option value="action" @selected(old('type') == 'action')>Action</option>
                            <option value="horror" @selected(old('type') == 'horror')>Horror</option>
                            <option value="drama" @selected(old('type') == 'drama')>Drama</option>
                        </select>
                        @error('type')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Rating --}}
                <div class="flex flex-col gap-1.5">
                    <label for="rating" class="text-sm font-medium text-gray-600">Rating</label>
                    <input type="text" id="rating" name="rating" value="{{ old('rating') }}"
                        placeholder="e.g. 8.5"
                        class="border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700
                               focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-purple-400 transition">
                    @error('rating')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="flex flex-col gap-1.5">
                    <label for="description" class="text-sm font-medium text-gray-600">Description</label>
                    <textarea id="description" name="description" rows="4" placeholder="Short synopsis..."
                        class="border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700 resize-none
                               focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-purple-400 transition">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Poster --}}
                <div class="flex flex-col gap-1.5">
                    <label for="poster" class="text-sm font-medium text-gray-600">Poster</label>
                    <input type="file" id="poster" name="poster"
                        class="border border-gray-200 rounded-xl px-4 py-2.5 text-sm
                               focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-purple-400 transition">
                    @error('poster')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Submit --}}
                <div class="flex gap-3 mt-2">
                    <button type="submit"
                        class="flex-1 bg-purple-600 hover:bg-purple-700 text-white font-medium py-2.5 rounded-xl text-sm transition">
                        Add Movie
                    </button>
                    <a href="/movies"
                        class="flex-1 text-center bg-gray-100 hover:bg-gray-200 text-gray-600 font-medium py-2.5 rounded-xl text-sm transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection