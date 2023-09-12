<x-app-layout>

    <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('List Penulis') }}
            </h2>
            <x-search-to :where="__('author')" />
            <x-create-to :create="__('author')"/>
    </x-slot>

    <div class="container mx-auto p-6">
        <div class="grid grid-cols-5 gap-4">
            @foreach ($authors as $author)
                <a href="{{ route('author.show', $author->id) }}" class="p-4 bg-white shadow rounded-lg hover:bg-gray-100 hover:underline transition duration-300">{{ $author->name }}</a>
            @endforeach
        </div>
    </div>
</x-app-layout>
