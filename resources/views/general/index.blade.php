@extends('layouts.app1')
@section('title','General Setting')
@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">General Setting</h6>

    </div>
    <div class="card-body">
        <div class="mb-3">
            <label for="formFile" class="form-label">Logo</label>
            <input class="form-control" type="file" id="formFile">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nama</label>
            <input type="text" class="form-control" name="nama" id="exampleFormControlInput1">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Alamat</label>
            <input type="text" class="form-control" name="alamat" id="exampleFormControlInput1">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">No Telp</label>
            <input type="text" class="form-control" name="no_telp" id="exampleFormControlInput1">
          </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>

    </div>
</div>
@endsection
