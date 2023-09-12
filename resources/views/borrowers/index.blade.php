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
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-600 text-left text-xs leading-4 font-medium dark:text-white uppercase tracking-wider">Thumbnail</th>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-600 text-left text-xs leading-4 font-medium dark:text-white uppercase tracking-wider">Nama Buku</th>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-600 text-left text-xs leading-4 font-medium dark:text-white uppercase tracking-wider">Nama Peminjam</th>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-600 text-left text-xs leading-4 font-medium dark:text-white uppercase tracking-wider">Jumlah Pinjam</th>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-600 text-left text-xs leading-4 font-medium dark:text-white uppercase tracking-wider text-center">Tanggal <br>Pinjam</th>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-600 text-left text-xs leading-4 font-medium dark:text-white uppercase tracking-wider text-center">Tanggal <br>Pengembalian</th>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-600 text-left text-xs leading-4 font-medium dark:text-white uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-700 dark:text-white">
                        @foreach ($borrowers as $borrower)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    <img src="{{ asset('image/thumbnail-book/' . $borrower->book->thumbnail) }}" alt="{{ $borrower->book->title }}" class="w-16 h-16 object-cover">
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap">{{ $borrower->book->title }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap">{{ $borrower->user->name }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap text-center">{{ $borrower->loan_amount }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap">{{ $borrower->borrow_date }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap">{{ $borrower->return_date }}</td>
                                <td class="px-6 py-4 flex whitespace-no-wrap">
                                    <button type="submit" class="bg-blue-500 text-white font-medium py-2 px-4 ml-3 rounded transition duration-300 ease-out hover:bg-blue-600">Setujui</button>
                                    <x-delete-to :del="__('borrower')" :where="$borrower->id" :name="$">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
