<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Peminjam Buku') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 bg-gray-50 dark:bg-gray-600 text-left text-xs leading-4 font-medium dark:text-white uppercase tracking-wider">
                                Thumbnail</th>
                            <th
                                class="px-6 py-3 bg-gray-50 dark:bg-gray-600 text-left text-xs leading-4 font-medium dark:text-white uppercase tracking-wider">
                                Nama Buku</th>
                            <th
                                class="px-6 py-3 bg-gray-50 dark:bg-gray-600 text-left text-xs leading-4 font-medium dark:text-white uppercase tracking-wider">
                                Nama Peminjam</th>
                            <th
                                class="px-6 py-3 bg-gray-50 dark:bg-gray-600 text-left text-xs leading-4 font-medium dark:text-white uppercase tracking-wider">
                                Jumlah Pinjam</th>
                            <th
                                class="px-6 py-3 bg-gray-50 dark:bg-gray-600 text-xs leading-4 font-medium dark:text-white uppercase tracking-wider text-center">
                                Tanggal <br>Pinjam</th>
                            <th
                                class="px-6 py-3 bg-gray-50 dark:bg-gray-600 text-xs leading-4 font-medium dark:text-white uppercase tracking-wider text-center">
                                Tanggal <br>Pengembalian</th>
                            <th
                                class="px-6 py-3 bg-gray-50 dark:bg-gray-600 text-left text-xs leading-4 font-medium dark:text-white uppercase tracking-wider">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-700 dark:text-white">
                        @foreach ($borrowers as $borrower)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    <img src="{{ asset('storage/image/thumbnail-book/' . $borrower->book->thumbnail) }}"
                                        alt="{{ $borrower->book->title }}" class="w-16 h-16 object-cover">
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap">{{ $borrower->book->title }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap">{{ $borrower->user->name }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap text-center">{{ $borrower->loan_amount }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap">{{ $borrower->borrow_date }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap">{{ $borrower->return_date }}</td>
                                <td class="px-6 py-4 flex whitespace-no-wrap">
                                    <button type="submit"
                                        class="bg-orange-500 text-white font-medium py-2 px-4 ml-3 rounded transition duration-300 ease-out hover:bg-orange-600"
                                        onclick="
                                            pinjam('{{ $borrower->book->title }}', '{{ $borrower->book->id }}', '{{ $borrower->user->name }}', '{{ $borrower->loan_amount }}', '{{ $borrower->return_date }}', '{{ $borrower->id }}')
                                        ">Edit</button>
                                    <x-delete-to :del="__('borrower')" :where="$borrower->id" :name="$borrower->book->title" />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <script>
                    function pinjam(name, bookId, user, pinjam, date, bor_id) {
                        Swal.fire({
                            title: `Peminjam buku ${name}`,
                            html: `<form id="pinjamForm" action="{{ route('borrower.update', '') }}/${bor_id}" method="post">
                                @method('PUT')
                                        @csrf
                                        <div class="grid grid-cols-2 gap-4">
                                            <input name="book_id" type="hidden" value="${bookId}">
                                            <input name="bor_id" type="hidden" value="${user}">
                                            <div class="mb-4">
                                                <label for="borrowerNumber" class="block text-gray-300 font-medium">Pinjam</label>
                                                <input id="borrowerNumber" class="swal2-input" name="pinjam" type="number" placeholder="Mau Pinjam Berapa" value="${pinjam}" required>
                                            </div>
                                            <div class="mb-4">
                                                <label for="tanggal" class="block text-gray-300 font-medium">Tanggal Pengembalian</label>
                                                <input type="date" id="tanggal" class="swal2-input" name="return_date" min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d', strtotime('+1 month')) }}" value="${date}" required>
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
            </div>
        </div>
    </div>
</x-app-layout>
