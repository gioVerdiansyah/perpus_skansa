<x-app-layout>

    <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('List Categories') }}
            </h2>
            <x-search-to :where="__('categories')" />
            <x-create-to :create="__('categories')"/>
    </x-slot>

    <div class="container mx-auto p-6">
        <div class="grid grid-cols-5 gap-4">
            @foreach ($categories as $category)
                <a href="{{ route('categories.show', $category->id) }}" class="p-4 bg-white shadow rounded-lg hover:bg-gray-100 hover:underline transition duration-300">{{ $category->name }}</a>
            @endforeach
        </div>
    </div>
</x-app-layout>
