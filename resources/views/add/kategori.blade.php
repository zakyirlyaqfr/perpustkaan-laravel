@extends('app', ['page' => 'kategori'])
@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add Kategori</h4>
                <form class="forms-sample" method="POST" action="/submitkategori">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputUsername1">Kategori</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Kategori" name="kategori">
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>
@endsection
