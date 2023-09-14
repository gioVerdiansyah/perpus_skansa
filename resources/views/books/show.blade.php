<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Buku') }}
        </h2>
        <x-back-to :back="__('books')" />
    </x-slot>

    <div class="bg-gray-800 min-h-screen text-white py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-700 shadow-xl rounded-lg overflow-hidden">
                <div class="sm:flex sm:items-center px-6 py-4">
                    <img src="{{ asset('storage/image/thumbnail-book/' . $book->thumbnail) }}" alt="Book Cover"
                        class="sm:w-48 mx-auto sm:mx-0 sm:mr-10 mb-4 sm:mb-0 rounded-lg shadow-md">
                    <div class="sm:text-left text-center">
                        <h1 class="text-3xl font-extrabold text-gray-100 leading-tight mb-2">{{ $book->title }}</h1>
                        <p class="text-xl text-gray-300">Penulis: {{ $book->author->name }}</p>
                        <p class="text-xl text-gray-300">Penerbit: {{ $book->publisher->name }}</p>
                        <p class="text-xl text-gray-300">ISBN: {{ $book->isbn }}</p>
                        <p class="text-xl text-gray-300">Kategori: {{ $book->category->name }}</p>
                        <p class="text-xl text-gray-300">Rating:
                            @php
                                $totalRatings = count($book->comment); // Jumlah total komentar
                                $sumRatings = $book->comment->sum('rating'); // Jumlah total rating
                                $averageRating = $totalRatings > 0 ? round($sumRatings / $totalRatings) : 0;
                                
                                if ($averageRating > 1) {
                                    $stars = '';
                                    for ($i = 1; $i <= 5; $i++) {
                                        $stars .= $i <= $averageRating ? '<i class="fa fa-star text-yellow-400"></i>' : '<i class="fa fa-star"></i>';
                                    }
                                    echo $stars;
                                } else {
                                    echo 'Belum ada rating';
                                }
                            @endphp
                        </p>
                    </div>
                </div>
                <div class="bg-gray-600 px-6 py-4">
                    <p class="text-lg text-gray-300">Deskripsi Buku:</p>
                    <p class="text-gray-400 mt-2">
                        {{ $book->description }}
                    </p>
                </div>
                <div class="bg-gray-800 px-6 py-4 flex justify-between">
                    <div>
                        <x-edit-to :edit="__('books')" :where="$book->id" />
                    </div>
                    <div>
                        <x-delete-to :del="__('books')" :where="$book->id" :name="$book->title" />
                    </div>
                </div>
            </div>
        </div>
        <!-- Bagian Komentar -->
        <div class="bg-gray-800 min-h-screen text-white py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray-700 shadow-xl rounded-lg overflow-hidden">
                    <div class="px-6 py-4">
                        <h2 class="text-2xl font-bold text-gray-100">Komentar</h2>
                    </div>

                    <!-- Form Komentar -->
                    <div class="bg-gray-600 px-6 py-4">
                        <form action="{{ route('books.comment.store', $book->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                            @error('book_id')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                            <div class="mb-4">
                                <label for="comment" class="block text-gray-300 text-sm font-medium mb-2">Komentar
                                    Anda</label>
                                <textarea name="comment_value" id="comment" rows="4"
                                    class="w-full bg-gray-700 text-gray-100 border border-gray-500 rounded-lg py-2 px-3 focus:outline-none focus:border-blue-400"></textarea>
                                @error('comment_value')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex items-center space-x-2 mb-4">
                                <label class="text-gray-400 cursor-pointer">
                                    <input type="radio" name="rating" value="1" class="hidden"
                                        onchange="toggleStar(this)">
                                    <i class="fas fa-star"></i>
                                </label>
                                <label class="text-gray-400 cursor-pointer">
                                    <input type="radio" name="rating" value="2" class="hidden"
                                        onchange="toggleStar(this)">
                                    <i class="fas fa-star"></i>
                                </label>
                                <label class="text-gray-400 cursor-pointer">
                                    <input type="radio" name="rating" value="3" class="hidden"
                                        onchange="toggleStar(this)">
                                    <i class="fas fa-star"></i>
                                </label>
                                <label class="text-gray-400 cursor-pointer">
                                    <input type="radio" name="rating" value="4" class="hidden"
                                        onchange="toggleStar(this)">
                                    <i class="fas fa-star"></i>
                                </label>
                                <label class="text-gray-400 cursor-pointer">
                                    <input type="radio" name="rating" value="5" class="hidden"
                                        onchange="toggleStar(this)">
                                    <i class="fas fa-star"></i>
                                </label>
                                @error('rating')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex justify-end">
                                <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-400 text-gray-100 rounded-lg py-2 px-4 focus:outline-none focus:bg-blue-400">Kirim</button>
                            </div>
                        </form>
                    </div>

                    <!-- Komentar Loop -->
                    @forelse ($book->comment as $comment)
                        <div class="bg-gray-600 px-6 py-4 flex justify-between items-center">
                            <div class="flex flex-col">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-100">{{ $comment->user->name }}</h3>
                                    <p class="text-gray-400 text-sm">{{ $comment->created_at->format('F j, Y H:i') }}
                                    </p>
                                </div>
                                <div class="flex-1 mt-3 text-gray-300">
                                    {{ $comment->comment_value }}
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                @if (auth()->check() && $comment->user_id === auth()->user()->id)
                                    <button class="text-gray-400 hover:text-gray-200"
                                        onclick="editComment({{ $comment->book_id }}, '{{ $comment->comment_value }}', '{{ $comment->rating }}')">Edit</button>
                                    <button class="text-red-500 hover:text-red-300"
                                        onclick="deleteComment({{ $comment->id }})">Hapus</button>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500 dark:text-gray-400 mt-4">Belum ada komentar</p>
                    @endforelse
                </div>
            </div>
        </div>
</x-app-layout>

<script>
    function toggleStar(radioElement) {
        const stars = document.querySelectorAll('.fas.fa-star');
        const selectedIndex = parseInt(radioElement.value) -
            1;

        for (let i = 0; i < stars.length; i++) {
            if (i <= selectedIndex) {
                stars[i].classList.remove('text-gray-400');
                stars[i].classList.add('text-yellow-400');
            } else {
                stars[i].classList.remove('text-yellow-400');
                stars[i].classList.add('text-gray-400');
            }
        }
    }

    function editComment(commentId, comment, rating) {
        const commentData = {
            comment: `${comment}`,
            rating: rating,
        };

        Swal.fire({
            title: 'Edit Komentar',
            html: `
        <form id="editCommentForm" action="{{ route('books.comment.update', '') }}/${commentId}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="book_id" value="${commentId}">
            <textarea id="editedComment" class="swal2-textarea" name="comment_value">${commentData.comment}</textarea>
            <div id="ratingStars" class="mt-2">
            </div>
            <button type="submit" class="bg-blue-500 text-white font-medium py-2 px-4 rounded transition duration-300 ease-out hover:bg-blue-600">Kirim</button>
                            <button type="reset" class="bg-red-500 text-white font-medium py-2 px-4 rounded transition duration-300 ease-out hover:bg-red-600">Reset</button>
        </form>
    `,
            showConfirmButton: false,
            showCancelButton: false,
            preConfirm: () => {
                const editedComment = document.getElementById('editedComment').value;
                const editedRating = document.querySelector('input[name="editedRating"]:checked').value;

                // Kirim data dengan metode POST ke route 'books.comment.update' (dengan method PUT)
                const formData = new FormData(document.getElementById('editCommentForm'));

                fetch(document.getElementById('editCommentForm').action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: formData,
                    })
                    .then((response) => {
                        if (!response.ok) {
                            throw new Error(response.statusText);
                        }
                        return response.json();
                    })
                    .then((data) => {
                        if (data && data.message) {
                            Swal.fire('Sukses!', data.message, 'success');
                        } else if (data && data.error) {
                            Swal.fire('Kesalahan!', data.error, 'error');
                        }
                    })
                    .catch((error) => {
                        Swal.fire('Kesalahan!', `Request gagal: ${error.message}`, 'error');
                    });
            },
            didOpen: () => {
                const ratingStarsContainer = document.getElementById('ratingStars');
                const selectedRating = parseInt(commentData.rating);

                for (let i = 1; i <= 5; i++) {
                    const star = document.createElement('label');
                    star.classList.add(i <= selectedRating ? 'text-yellow-400' : 'text-gray-400',
                        'hover:text-yellow-300', 'cursor-pointer');
                    star.innerHTML = `
            <input type="radio" name="rating" value="${i}" class="hidden"
                ${i === selectedRating ? 'checked' : ''}>
            <i class="fas fa-star"></i>`;
                    ratingStarsContainer.appendChild(star);

                    star.addEventListener('click', () => {
                        const stars = ratingStarsContainer.querySelectorAll('label');
                        stars.forEach((s, index) => {
                            s.classList.toggle('text-yellow-400', index < i);
                        });
                    });
                }
            }

        });
    }

    function deleteComment(commentId) {
        Swal.fire({
            title: 'Hapus Komentar',
            text: 'Anda yakin ingin menghapus komentar ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                const deleteForm = document.createElement('form');
                deleteForm.method = 'POST';
                deleteForm.action = `{{ route('books.comment.delete', '') }}/${commentId}`;
                deleteForm.innerHTML = `
                @csrf
                @method('DELETE')
            `;
                document.body.appendChild(deleteForm);
                deleteForm.submit();
            }
        });
    }
</script>
