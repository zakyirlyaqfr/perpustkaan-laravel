@extends('app', ['page' => 'roles'])

@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h2>Update Menu Role : {{ $role->nama_jenis_user }}</h2>
                    <form action="{{ route('roles.savemenu', $role->id_jenis_user) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <h4>Menu Yang Belum Dimiliki:</h4>
                            @foreach($notmenuroles as $menu)
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox"
                                           class="custom-control-input"
                                           id="menu_{{ $menu->menu_id }}"
                                           name="menu_id[]"
                                           value="{{ $menu->menu_id }}">
                                    <label class="custom-control-label" for="menu_{{ $menu->menu_id }}">
                                        {{ $menu->menu_name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="form-group mt-4">
                            <h4>Menu yang dimiliki:</h4>
                            @foreach($menuroles as $menu)
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox"
                                           class="custom-control-input"
                                           id="menu_owned_{{ $menu->menu_id }}"
                                           name="menu_id[]"
                                           value="{{ $menu->menu_id }}"
                                           checked>
                                    <label class="custom-control-label" for="menu_owned_{{ $menu->menu_id }}">
                                        {{ $menu->menu_name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
                        <a href="{{ route('admin.addrole') }}" class="btn btn-secondary mt-3 ms-2">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .custom-control-label {
            font-size: 1.1rem;
            font-weight: 500;
        }
    </style>
@endsection
