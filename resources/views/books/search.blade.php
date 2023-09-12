<x-app-layout>
    <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('List Buku') }}
            </h2>
            <x-back-to :back="__('books')"/>
    </x-slot>

    <div class="py-12 " id="books">
        <div class="mx-auto flex flex-wrap sm:px-6 lg:px-8">
        @foreach ($books as $book)
            <div class="max-w-md mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden md:max-w-2xl mt-4">
              <div class="md:flex">
                <div class="md:flex-shrink-0 p-7">
                  <img class="w-full object-cover md:w-40 border-2 border-" src="{{ asset('image/thumbnail-book/' . $book->thumbnail) }}" alt="Gambar Buku">
                </div>
                <div class="p-8 flex flex-col justify-evenly">
                <div class="flex flex-col">
                    <p class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">{{ $book->category->name }}</p>
                    <a href="{{ route('books.show', $book) }}" class="block mt-1 text-lg leading-tight font-medium text-gray-500 hover:underline transition duration-300">{{ $book['title'] }}</a>
                    <p class="m-5 text-white">{{ $book->description }}</p>
                </div>
                <div class="flex flex-column">
                    {{-- Jangan lupa di ganti ke halaman pinjam --}}
                    <a href="{{ route('login') }}" class="w-max p-2 ml-3 rounded text-white bg-orange-500 hover:bg-orange-600
                    hover:text-indigo-700 hover:underline duration-300 ease-out">Pinjam<i class="fa-solid fa-delete-left ml-1"></i></a>
                </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    </div>
</x-app-layout>
