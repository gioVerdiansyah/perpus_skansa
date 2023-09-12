<x-app-layout>
    <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Tambah Kategori') }}
            </h2>
            <x-back-to :back="__('publisher')"/>
    </x-slot>
    <div class="container mx-auto mt-10">
        <div class="max-w-md mx-auto bg-gray-900 p-5 rounded-md shadow-md">
            <h1 class="text-2xl font-semibold text-white mb-4">Tambah Kategori</h1>

            <form action="{{ route('publisher.update', $publisher) }}" method="POST">
                @method('PUT')
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-gray-300 font-medium">Nama Penerbit</label>
                    <input type="text" name="name" id="name" class="form-input mt-1 block w-full rounded-md dark:bg-gray-700 dark:border-gray-600 @error('name') border-red-500 @enderror" value="{{ old('name', $publisher->name) }}">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="address" class="block text-gray-300 font-medium">Alamat</label>
                    <textarea name="address" id="address" rows="3" class="form-textarea mt-1 block w-full rounded-md dark:bg-gray-700 dark:border-gray-600 @error('address') border-red-500 @enderror">{{ old('address', $publisher->address) }}</textarea>
                    @error('address')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-300 font-medium">Email</label>
                    <input type="email" name="email" id="email" class="form-input mt-1 block w-full rounded-md dark:bg-gray-700 dark:border-gray-600 @error('email') border-red-500 @enderror" value="{{ old('email', $publisher->email) }}">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="phone" class="block text-gray-300 font-medium">Nomor Telepon</label>
                    <input type="tel" name="phone" id="phone" class="form-input mt-1 block w-full rounded-md dark:bg-gray-700 dark:border-gray-600 @error('phone') border-red-500 @enderror" value="{{ old('phone', $publisher->phone) }}">
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="website" class="block text-gray-300 font-medium">Website</label>
                    <input type="url" name="website" id="website" class="form-input mt-1 block w-full rounded-md dark:bg-gray-700 dark:border-gray-600 @error('website') border-red-500 @enderror" value="{{ old('website', $publisher->website) }}">
                    @error('website')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <img src="{{ asset('image/logo-publisher/' . $publisher->logo) }}" alt="logo publisher" id="img" width="70">
                    <label for="logo" class="block text-gray-300 font-medium">Logo</label>
                    <input type="file" name="logo" id="logo" class="form-input mt-1 block w-full rounded-md dark:bg-gray-700 dark:border-gray-600 @error('logo') border-red-500 @enderror" accept="image/*" value="{{$publisher}}" onchange="
                        let reader = new FileReader();
                        reader.onload = function(e) {
						document.getElementById('img').src = e.target.result;
					}
					reader.readAsDataURL(this.files[0]);
                    " >
                    @error('logo')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="since" class="block text-gray-300 font-medium">Tahun Berdiri</label>
                    <input type="text" name="since" id="since" class="form-input mt-1 block w-full rounded-md dark:bg-gray-700 dark:border-gray-600 @error('since') border-red-500 @enderror" value="{{ old('since', $publisher->since) }}">
                    @error('since')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-gray-300 font-medium">Deskripsi</label>
                    <textarea name="description" id="description" rows="5" class="form-textarea mt-1 block w-full rounded-md dark:bg-gray-700 dark:border-gray-600 @error('description') border-red-500 @enderror">{{ old('description', $publisher->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-4">
                    <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
