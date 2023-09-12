<x-app-layout>

    <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit Buku') }}
            </h2>
            <x-back-to :back="__('books')"/>
    </x-slot>

<div class="bg-gray-800 min-h-screen text-white py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-700 shadow-xl rounded-lg overflow-hidden">
            <div class="sm:flex sm:items-center px-6 py-4">
                <img src="{{ asset('image/thumbnail-book/'. $book->thumbnail) }}" alt="Book Cover" class="sm:w-48 mx-auto sm:mx-0 sm:mr-10 mb-4 sm:mb-0 rounded-lg shadow-md">
                <div class="sm:text-left text-center">
                    <h1 class="text-3xl font-extrabold text-gray-100 leading-tight mb-2">{{ $book->title }}</h1>
                    <p class="text-xl text-gray-300">Penulis: {{ $book->author->name }}</p>
                    <p class="text-xl text-gray-300">Penerbit: {{ $book->publisher->name }}</p>
                    <p class="text-xl text-gray-300">ISBN: {{ $book->isbn }}</p>
                    <p class="text-xl text-gray-300">Kategori: {{ $book->category->name }}</p>
                </div>
            </div>
            <div class="bg-gray-600 px-6 py-4">
                <p class="text-lg text-gray-300">Deskripsi Buku:</p>
                <p class="text-gray-400 mt-2">
                    {{ $book->description }}
                </p>
            </div>
            <div class="bg-gray-800 px-6 py-4 flex justify-between">
                <div>
                    <x-edit-to :edit="__('books')" :where="$book->id"/>
                </div>
                <div>
                    <x-delete-to :del="__('books')" :where="$book->id" :name="$book->title"/>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>


