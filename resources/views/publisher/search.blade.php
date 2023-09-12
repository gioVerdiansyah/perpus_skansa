<x-app-layout>
    <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('List Penulis') }}
            </h2>
            <x-back-to :back="__('publisher')"/>
    </x-slot>

    <div class="container mx-auto p-6">
        <div class="grid grid-cols-5 gap-4">
            @forelse ($publishers as $row)
                <a href="{{ route('publisher.show', $row->id) }}" class="p-4 bg-white shadow rounded-lg hover:bg-gray-100 hover:underline transition duration-300">{{ $row->name }}</a>
            @empty
            <p class="text-center text-gray-500 dark:text-gray-400 mt-4">Tidak ada data yang ditemukan</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
