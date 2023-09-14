<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('List Buku') }}
        </h2>
        <x-back-to :back="__('books')" />
    </x-slot>

    <div class="py-12 " id="books">
        <div class="mx-auto flex flex-wrap sm:px-6 lg:px-8">
            @forelse ($books as $book)
                <div
                    class="max-w-md mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden md:max-w-2xl mt-4">
                    <div class="md:flex">
                        <div class="md:flex-shrink-0 p-7">
                            <img class="w-full object-cover md:w-40 border-2 border-"
                                src="{{ asset('storage/image/thumbnail-book/' . $book->thumbnail) }}" alt="Gambar Buku">
                        </div>
                        <div class="p-8 flex flex-col justify-evenly">
                            <div class="flex flex-col">
                                <p class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">
                                    {{ $book->category->name }}</p>
                                <a href="{{ route('books.show', $book) }}"
                                    class="block mt-1 text-lg leading-tight font-medium text-gray-500 hover:underline transition duration-300">{{ $book['title'] }}</a>
                                <p class="m-5 text-white">{{ $book->description }}</p>
                            </div>
                            <div class="flex flex-column">
                                <button
                                    class="w-max p-2 ml-3 rounded text-white bg-orange-500 hover:bg-orange-600
                hover:text-indigo-700 hover:underline duration-300 ease-out"
                                    id="pinjam" onclick="pinjam('{{ $book->title }}', '{{ $book->id }}')">Pinjam
                                    <i class="fa-solid fa-book"></i>
                                </button>
                                <button
                                    class="w-max p-2 ml-3 rounded text-white bg-orange-500 hover:bg-orange-600
                hover:text-indigo-700 hover:underline duration-300 ease-out"
                                    id="komentar"
                                    onclick="window.location.href = '{{ route('books.show', $book->id) }}'">Komentar
                                    <i class="fa-solid fa-comment"></i>
                                </button>
                            </div>
                        @empty
                            <p class="text-center text-gray-500 dark:text-gray-400 mt-4">Tidak ada data yang ditemukan
                            </p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
<script>
    function pinjam(name, bookId) {
        Swal.fire({
            title: `Peminjam buku ${name}`,
            html: `<form id="pinjamForm" action="{{ route('borrower.store') }}" method="post">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <input name="book_id" type="hidden" value="${bookId}">
                            <input name="bor_id" type="hidden" value="{{ Auth::user()->name }}">
                            <div class="mb-4">
                                <label for="borrowerNumber" class="block text-gray-300 font-medium">Pinjam</label>
                                <input id="borrowerNumber" class="swal2-input" name="pinjam" type="number" placeholder="Mau Pinjam Berapa" required>
                            </div>
                            <div class="mb-4">
                                <label for="tanggal" class="block text-gray-300 font-medium">Tanggal Pengembalian</label>
                                <input type="date" id="tanggal" class="swal2-input" name="return_date" min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d', strtotime('+1 month')) }}" required>
                            </div>
                        </div>
                        <button type="submit" class="bg-blue-500 text-white font-medium py-2 px-4 rounded transition duration-300 ease-out hover:bg-blue-600">Kirim</button>
                        <button type="reset" class="bg-red-500 text-white font-medium py-2 px-4 rounded transition duration-300 ease-out hover:bg-red-600">Reset</button>
                    </form>`,
            showCancelButton: false,
            showConfirmButton: false
        });
        const form = document.getElementById('pinjamForm');

        // Tambahkan event listener untuk menghandle submit form secara asynchronous
        form.addEventListener('submit', async (e) => {
            e.preventDefault(); // Menghentikan submit form bawaan

            const formData = new FormData(form); // Dapatkan data form

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                });

                if (!response.ok) {
                    throw new Error(response.statusText);
                }

                const data = await response.json();

                if (data && data.message) {
                    Swal.fire('Sukses!', data.message, 'success');
                } else if (data && data.error) {
                    Swal.fire('Kesalahan!', data.error, 'error');
                }
            } catch (error) {
                Swal.fire('Kesalahan!', `Request gagal: ${error.message}`, 'error');
            }
        });
    };
</script>
