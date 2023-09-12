<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Penulis') }}
        </h2>
        <x-back-to :back="__('author')"/>
    </x-slot>

    <div class="container mx-auto mt-10">
        <div class="max-w-md mx-auto bg-gray-900 p-5 rounded-md shadow-md">
            <h1 class="text-2xl font-semibold text-white mb-4">Tambah Penulis</h1>

            <form action="{{ route('author.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-gray-300 font-medium">Nama Penulis</label>
                    <input type="text" name="name" id="name" class="form-input mt-1 block w-full rounded-md dark:bg-gray-700 dark:border-gray-600 @error('name') border-red-500 @enderror" value="{{ old('name') }}" required>
                    @error('name')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-300 font-medium">Email</label>
                    <input type="email" name="email" id="email" class="form-input mt-1 block w-full rounded-md dark:bg-gray-700 dark:border-gray-600 @error('email') border-red-500 @enderror" value="{{ old('email') }}" required>
                    @error('email')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="address" class="block text-gray-300 font-medium">Alamat</label>
                    <textarea name="address" id="address" rows="3" class="form-textarea mt-1 block w-full rounded-md dark:bg-gray-700 dark:border-gray-600 @error('address') border-red-500 @enderror" required>{{ old('address') }}</textarea>
                    @error('thumbnail')
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
