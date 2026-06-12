<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex flex-column flex-md-row align-items-start justify-content-between">
                <div>
                    <h4 class="card-title">Dashboard Mahasiswa</h4>
                    <p class="card-description mb-0">Daftar pinjaman buku Anda.</p>
                </div>
                <div class="mt-3 mt-md-0">
                    <h4 class="card-title">Daftar Pinjaman</h4>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success mt-3">{{ session('success') }}</div>
            @endif

            <div class="table-responsive mt-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Judul Buku</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
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
                                <td>
                                    @if($item->status == 'dipinjam')
                                        <span class="badge badge-warning">Dipinjam</span>
                                    @else
                                        <span class="badge badge-success">Dikembalikan</span>
                                    @endif
                                </td>
                                <td>{{ $item->tanggal_pinjam ? $item->tanggal_pinjam->format('d M Y H:i') : '-' }}</td>
                                <td>{{ $item->tanggal_kembali ? $item->tanggal_kembali->format('d M Y H:i') : '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Belum ada pinjaman.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
