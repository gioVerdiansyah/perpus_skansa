<x-app-layout>
    <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Tambah Kategori') }}
            </h2>
            <x-back-to :back="__('categories')"/>
    </x-slot>
    <div class="container mx-auto mt-10">
        <div class="max-w-md mx-auto bg-gray-900 p-5 rounded-md shadow-md">
            <h1 class="text-2xl font-semibold text-white mb-4">Tambah Kategori</h1>

            <form action="{{ route('categories.update', $category) }}" method="POST">
                @method('PUT')
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-gray-300 font-medium">Nama Kategori</label>
                    <input type="text" name="name" id="name" class="form-input mt-1 block w-full rounded-md dark:bg-gray-700 dark:border-gray-600" value="{{ $category->name }}" required>
                    @error('name')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-4">
                    <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
