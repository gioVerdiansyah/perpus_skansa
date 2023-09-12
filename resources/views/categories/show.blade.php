<x-app-layout>
    <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('List Categories ' . $categories->name) }}
            </h2>
            <div class="flex">
                <x-edit-to class="mr-5" :edit="__('categories')" :where="$categories"/>
                <x-delete-to :del="__('categories')" :where="$categories" :name="$categories->name"/>
                <x-back-to :back="__('categories')"/>
            </div>
    </x-slot>

    <div class="container mx-auto p-6">
        <div class="grid grid-cols-5 gap-4">
            @forelse ($categories->book as $row)
                    <a href="{{ route('books.show', $row->id) }}" class="p-4 bg-white shadow rounded-lg hover:bg-gray-100 hover:underline transition duration-300">{{ $row->title }}</a>
                @empty
                <p class="text-center text-gray-500 dark:text-gray-400 mt-4">Belum ada Kategori yang terkait</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
