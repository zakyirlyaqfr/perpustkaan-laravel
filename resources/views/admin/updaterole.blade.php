@extends('app', ['page' => 'roles'])
@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Role</h4>
                    <p class="card-description">Update the role name</p>
                    <form action="{{ route('roles.update', $role->id_jenis_user) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="role_name">Role Name</label>
                            <input type="text" class="form-control" id="role_name" name="role_name" value="{{ $role->nama_jenis_user }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Role</button>
                        <a href="{{ route('admin.addrole') }}" class="btn btn-secondary ms-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
