@extends('layouts.app1')
@section('title','Edit Pelanggan')
@push('css')

@endpush
@section('content')
<h1 class="h3 mb-2 text-gray-800">Edit Pelanggan</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Pelanggan</h6>

    </div>
    <div class="card-body">
        <form action="{{ route('pelanggan.update',$pelanggan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Nama Pelanggan</label>
              <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="exampleInputEmail1"  value="{{ $pelanggan->nama }}" aria-describedby="emailHelp" >
              <span style="color : red">@error('nama') {{ $message }} @enderror</span>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">No Telp.</label>
                <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" id="exampleInputEmail1"  value="{{ $pelanggan->no_hp }}" aria-describedby="emailHelp" >
                <span style="color : red">@error('no_hp') {{ $message }} @enderror</span>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Alamat</label>
                <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="exampleInputEmail1"  value="{{ $pelanggan->alamat }}" aria-describedby="emailHelp" >
                <span style="color : red">@error('alamat') {{ $message }} @enderror</span>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
    </div>
</div>
@endsection
@push('script')

@endpush
