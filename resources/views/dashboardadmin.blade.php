@extends('app', ['page' => 'dashboardadmin'])

@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Dashboard Admin</h4>
                    <p class="card-description">Daftar user, role, dan menu yang tersedia.</p>
                </div>
            </div>
        </div>

        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar User</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>No. HP</th>
                                    <th>Jenis User</th>
                                    <th>Update/Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->no_hp }}</td>
                                        <td>{{ $user->jenisUser->nama_jenis_user ?? '-' }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="User actions">
                                                <a href="/edituser/{{ $user->user_id }}" class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('users.destroy', $user->user_id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm ms-1" onclick="return confirm('Yakin ingin menghapus user ini?');">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar Role</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Role</th>
                                    <th>Update/Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $role)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $role->nama_jenis_user }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Role actions">
                                                <a href="{{ route('roles.show', $role->id_jenis_user) }}" class="btn btn-info btn-sm">View</a>
                                                <a href="{{ route('roles.edit', $role->id_jenis_user) }}" class="btn btn-warning btn-sm ms-1">Edit</a>
                                                <a href="{{ route('roles.addmenu', $role->id_jenis_user) }}" class="btn btn-primary btn-sm ms-1">Tambahkan Menu Role</a>
                                                <form action="{{ route('roles.destroy', $role->id_jenis_user) }}" method="POST" class="d-inline ms-1">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this role?');">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar Menu</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Menu Name</th>
                                    <th>Menu Link</th>
                                    <th>Menu Icon</th>
                                    <th>Parent ID</th>
                                    <th>Update/Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($menus as $menu)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $menu->menu_name }}</td>
                                        <td>{{ $menu->menu_link }}</td>
                                        <td>{{ $menu->menu_icon }}</td>
                                        <td>{{ $menu->parent_id }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Menu actions">
                                                <a href="{{ route('menu.edit', $menu->menu_id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('menu.destroy', $menu->menu_id) }}" method="POST" class="d-inline ms-1">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this menu?');">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
