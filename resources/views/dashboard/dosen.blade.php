<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Dashboard Dosen</h4>
            <p class="card-description">Daftar buku dan kategori yang tersedia.</p>
        </div>
    </div>
</div>

<div class="card-body col-12">
    <h4 class="card-title">Daftar Buku</h4>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pengarang</th>
                    <th>Judul</th>
                    <th>Kode</th>
                    <th>Kategori</th>
                    <th>Tanggal Ditambahkan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                    <tr id="book-row-{{ $book->id_buku }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $book->pengarang }}</td>
                        <td>{{ $book->judul }}</td>
                        <td>{{ $book->kode }}</td>
                        <td>{{ $book->id_kategori ? $book->kategori->nama_kategori : 'Kosong' }}</td>
                        <td>{{ $book->created_at->format('d M Y') }}</td>
                        <td>
                            @if ($book->activePinjaman)
                                <button type="button" class="btn btn-warning btn-sm" disabled>Dipinjam</button>
                            @elseif ($book->status)
                                <button type="button" class="btn btn-danger btn-sm delete-book"
                                    data-id="{{ $book->id_buku }}">Delete</button>
                            @else
                                <span>-</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="card-body col-12 mt-4">
    <h4 class="card-title">Daftar Kategori</h4>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Dibuat Sejak</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kategori as $k)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $k->nama_kategori }}</td>
                    <td>{{ $k->created_at->format('d M Y') }}</td>
                    <td>
                        @if($k->status)
                            Aktif
                        @else
                            Non-aktif
                        @endif
                    </td>
                    <td>
                        @if($k->status)
                            <form action="/kategori/{{ $k->id_kategori }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus kategori ini?');">Delete</button>
                            </form>
                        @else
                            <span>-</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).on('click', '.delete-book', function() {
        var bookId = $(this).data('id');

        if (confirm('Apakah kamu yakin ingin menghapus buku ini?')) {
            $.ajax({
                url: '/books/' + bookId,
                type: 'DELETE',
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        $('#book-row-' + bookId).remove();
                    } else {
                        alert(response.message);
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan saat menghapus buku.');
                }
            });
        }
    });

</script>
