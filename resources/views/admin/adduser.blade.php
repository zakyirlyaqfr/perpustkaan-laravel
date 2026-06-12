@extends('app', ['page' => 'users'])

@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card-body">
            <h4 class="card-title">Tambahkan User</h4>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nama pengguna" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email pengguna" required>
                </div>

                <div class="form-group">
                    <label for="no_hp">No. HP</label>
                    <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Nomor HP" required>
                </div>

                <div class="form-group">
                    <label for="id_jenis_user">Jenis User</label>
                    <select class="form-select" id="id_jenis_user" name="id_jenis_user" required>
                        <option value="">Pilih Jenis User</option>
                        @foreach($jenis_user as $jenis)
                            <option value="{{ $jenis->id_jenis_user }}">{{ $jenis->nama_jenis_user }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Daftarkan User</button>
            </form>
        </div>
    </div>
@endsection
