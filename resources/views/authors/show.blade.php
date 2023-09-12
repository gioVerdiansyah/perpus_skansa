<x-app-layout>
    <x-slot name="header">
        <div class="mb-4">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Detail Penulis ' . $author->name) }}
            </h2>
            <p class="text-gray-500 dark:text-gray-400">Email: {{ $author->email }}</p>
            <p class="text-gray-500 dark:text-gray-400">Alamat: {{ $author->address }}</p>
        </div>
        <div class="flex">
            <x-edit-to class="mr-5" :edit="__('author')" :where="$author"/>
            <x-delete-to :del="__('author')" :where="$author" :name="$author->name"/>
            <x-back-to :back="__('author')"/>
        </div>
    </x-slot>

    <div class="container mx-auto p-6">
        <div class="grid grid-cols-5 gap-4">
            @forelse ($author->book as $row)
                <a href="{{ route('author.show', $row->id) }}" class="p-4 bg-white shadow rounded-lg hover:bg-gray-100 hover:underline transition duration-300">{{ $row->title }}</a>
            @empty
                <p class="text-center text-gray-500 dark:text-gray-400 mt-4">Belum ada Penulis yang terkait</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
