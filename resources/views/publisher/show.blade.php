<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Penerbit ' . $publisher->name) }}
        </h2>
        <div class="flex">
            <x-edit-to class="mr-5" :edit="__('publisher')" :where="$publisher" />
            <x-delete-to :del="__('publisher')" :where="$publisher" :name="$publisher->name" />
            <x-back-to :back="__('publisher')" />
        </div>
    </x-slot>

    <div class="container mx-auto p-6">
        <div class="grid grid-cols-5 gap-4">
            @forelse ($publisher->book as $row)
                <a href="{{ route('publisher.show', $row->id) }}"
                    class="p-4 bg-white shadow rounded-lg hover:bg-gray-100 hover:underline transition duration-300">{{ $row->title }}</a>
            @empty
                <p class="text-center text-gray-500 dark:text-gray-400 mt-4">Belum ada Penerbit yang terkait</p>
            @endforelse
        </div>

        <div class="mt-6 bg-white shadow p-6 rounded-lg dark:bg-gray-800">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Detail Penerbit</h2>
            <dl class="grid grid-cols-2 gap-4">
                <div class="col-span-2 sm:col-span-1">
                    <dt class="text-gray-600 dark:text-gray-400">Nama</dt>
                    <dd class="text-gray-900 dark:text-gray-200">{{ $publisher->name }}</dd>
                </div>
                <div class="col-span-2 sm:col-span-1">
                    <dt class="text-gray-600 dark:text-gray-400">Alamat</dt>
                    <dd class="text-gray-900 dark:text-gray-200">{{ $publisher->address }}</dd>
                </div>
                <div class="col-span-2 sm:col-span-1">
                    <dt class="text-gray-600 dark:text-gray-400">Email</dt>
                    <dd class="text-gray-900 dark:text-gray-200">{{ $publisher->email }}</dd>
                </div>
                <div class="col-span-2 sm:col-span-1">
                    <dt class="text-gray-600 dark:text-gray-400">Telepon</dt>
                    <dd class="text-gray-900 dark:text-gray-200">{{ $publisher->phone }}</dd>
                </div>
                <div class="col-span-2 sm:col-span-1">
                    <dt class="text-gray-600 dark:text-gray-400">Website</dt>
                    <dd class="text-gray-900 dark:text-gray-200">{{ $publisher->website }}</dd>
                </div>
                <div class="col-span-2 sm:col-span-1">
                    <dt class="text-gray-600 dark:text-gray-400">Logo</dt>
                    <dd>
                        <img src="{{ asset('storage/image/logo-publisher/' . $publisher->logo) }}"
                            alt="Logo Penerbit {{ $publisher->name }}" class="h-24 w-24 object-contain">
                    </dd>
                </div>
                <div class="col-span-2 sm:col-span-1">
                    <dt class="text-gray-600 dark:text-gray-400">Tahun Berdiri</dt>
                    <dd class="text-gray-900 dark:text-gray-200">{{ $publisher->since }}</dd>
                </div>
                <div class="col-span-2">
                    <dt class="text-gray-600 dark:text-gray-400">Deskripsi</dt>
                    <dd class="text-gray-900 dark:text-gray-200">{{ $publisher->description }}</dd>
                </div>
            </dl>
        </div>
    </div>
</x-app-layout>
