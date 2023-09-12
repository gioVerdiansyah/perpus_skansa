@props(['del','where', 'name'])

<form action="{{ route($del . '.destroy', $where) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="bg-red-600 hover:bg-red-500 text-white font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline-red active:bg-red-800" onclick="
    event.preventDefault();
        Swal.fire({
                                      title: 'Hapus {{ ucfirst($del) }}!',
                                      text: 'Apakah kamu yakin ingin menghapus {{ $name }}?',
                                      icon: 'warning',
                                      showCancelButton: true,
                                      confirmButtonColor: '#3085d6',
                                      cancelButtonColor: '#d33',
                                      confirmButtonText: 'Yes'
                                    }).then((result) => {
                                      if (result.isConfirmed) {
                                        this.closest('form').submit();
                                      }
                                    })
    ">
        Delete
    </button>
</form>
