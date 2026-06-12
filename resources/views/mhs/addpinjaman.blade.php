@extends('app', ['page' => 'pinjaman'])

@section('content')
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
                        <th>Status Pinjam</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $book->pengarang }}</td>
                            <td>{{ $book->judul }}</td>
                            <td>{{ $book->kode }}</td>
                            <td>{{ $book->id_kategori ? $book->kategori->nama_kategori : 'Kosong' }}</td>
                            <td>
                                @if($book->activePinjaman)
                                    <span class="badge badge-warning">Dipinjam</span>
                                @else
                                    <span class="badge badge-success">Tersedia</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form Peminjaman Buku</h4>

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form class="forms-sample" method="POST" action="{{ route('mhs.pinjaman.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', Auth::user()->name) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="nim">NIM</label>
                        <input type="text" class="form-control" id="nim" name="nim" value="{{ old('nim') }}" placeholder="Masukkan NIM" required>
                    </div>

                    <div class="form-group">
                        <label for="id_buku">Daftar Peminjaman Buku Tersedia</label>
                        <select class="form-select form-select-lg" id="id_buku" name="id_buku" required>
                            <option value="">Pilih Buku</option>
                            @foreach ($availableBooks as $book)
                                <option value="{{ $book->id_buku }}">
                                    {{ $book->judul }} - {{ $book->kode }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary me-2">Pinjam</button>
                </form>
            </div>
        </div>
    </div>
@endsection
