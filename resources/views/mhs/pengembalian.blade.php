@extends('app', ['page' => 'pengembalian'])

@section('content')
    <div class="card-body col-12">
        <h4 class="card-title">Pengembalian Buku</h4>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Judul Buku</th>
                        <th>Kategori</th>
                        <th>Tanggal Pinjam</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pinjaman as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->nim }}</td>
                            <td>{{ $item->buku->judul ?? '-' }}</td>
                            <td>{{ $item->buku && $item->buku->kategori ? $item->buku->kategori->nama_kategori : '-' }}</td>
                            <td>{{ $item->tanggal_pinjam ? $item->tanggal_pinjam->format('d M Y H:i') : '-' }}</td>
                            <td>
                                <form action="{{ route('mhs.pengembalian.submit', $item->id_pinjaman) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('Kembalikan buku ini?');">Kembalikan</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada buku yang sedang dipinjam.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
