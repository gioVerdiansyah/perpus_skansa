<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Buku') }}
        </h2>
        <x-back-to :back="__('books')" />
    </x-slot>

    <div class="container mx-auto mt-8 dark:text-white">
        <div class="max-w-md mx-auto dark:bg-gray-700 p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold mb-4">Edit Buku</h2>

            <form method="POST" action="{{ route('books.update', $book) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="mb-4">
                    <label for="isbn" class="block text-gray-300 font-medium">ISBN</label>
                    <input id="isbn" type="text"
                        class="form-input rounded dark:bg-gray-500 w-full dark:border-gray-600 @error('isbn') border-red-500 @enderror"
                        name="isbn" value="{{ $book->isbn }}" required autofocus>
                    @error('isbn')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="title" class="block text-gray-300 font-medium">Judul Buku</label>
                    <input id="title" type="text"
                        class="form-input rounded dark:bg-gray-500 w-full dark:border-gray-600 @error('title') border-red-500 @enderror"
                        name="title" value="{{ $book->title }}" required>
                    @error('title')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="categories" class="block text-gray-300 font-medium">Kategori</label>
                    <input id="categories" type="text"
                        class="form-input rounded dark:bg-gray-500 w-full dark:border-gray-600 @error('categories') border-red-500 @enderror"
                        name="categories" value="{{ $book->category->name }}" required>
                    @error('categories')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="author" class="block text-gray-300 font-medium">Penulis</label>
                    <input id="author" type="text"
                        class="form-input rounded dark:bg-gray-500 w-full dark:border-gray-600 @error('author') border-red-500 @enderror"
                        name="author" value="{{ $book->author->name }}" required>
                    @error('author')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="publisher" class="block text-gray-300 font-medium">Penerbit</label>
                    <input id="publisher" type="text"
                        class="form-input rounded dark:bg-gray-500 w-full dark:border-gray-600 @error('publisher') border-red-500 @enderror"
                        name="publisher" value="{{ $book->publisher->name }}" required>
                    @error('publisher')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                {{-- <input type="hidden" name="oldThumbnail" value="{{ $book->thumbnail }}"> --}}

                <div class="mb-4">
                    <img src="{{ asset('image/thumbnail-book/' . $book->thumbnail) }}"
                        alt="Thumbnail buku {{ $book->title }}" id="img" width="70">
                    <label for="thumbnail" class="block text-gray-300 font-medium">Thumbnail</label>
                    <input id="thumbnail" type="file" value="{{ $book->thumbnail }}"
                        class="form-input rounded dark:bg-gray-500 w-full dark:border-gray-600 @error('thumbnail') border-red-500 @enderror"
                        name="thumbnail"
                        onchange="
					let reader = new FileReader();
					reader.onload = function(e) {
						document.getElementById('img').src = e.target.result;
					}
					reader.readAsDataURL(this.files[0]);
                    ">
                    @error('thumbnail')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-gray-300 font-medium">Deskripsi</label>
                    <textarea id="description"
                        class="form-textarea w-full rounded dark:bg-gray-500 dark:border-gray-600 @error('description') border-red-500 @enderror"
                        name="description" rows="4" required>{{ $book->description }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <button type="submit"
                        class="bg-blue-500 text-white font-medium py-2 px-4 rounded transition duration-300 ease-out hover:bg-blue-600">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
