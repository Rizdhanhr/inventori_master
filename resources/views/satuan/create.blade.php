@extends('layouts.app1')
@section('title','Tambah Satuan')
@push('css')

@endpush
@section('content')
<h1 class="h3 mb-2 text-gray-800">Tambah Satuan</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Satuan</h6>

    </div>
    <div class="card-body">
        <form action="{{ route('satuan.store') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Nama Satuan</label>
              <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="exampleInputEmail1"  value="{{ old('nama') }}" aria-describedby="emailHelp" placeholder="Masukkan Nama Satuan">
              <span style="color : red">@error('nama') {{ $message }} @enderror</span>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
    </div>
</div>
@endsection
@push('script')

@endpush
