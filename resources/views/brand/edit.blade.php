@extends('layouts.app1')
@section('title','Edit Brand')
@push('css')

@endpush
@section('content')
<h1 class="h3 mb-2 text-gray-800">Edit Brand</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Brand</h6>

    </div>
    <div class="card-body">
        <form action="{{ route('brand.update',$brand->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Nama Brand</label>
              <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="exampleInputEmail1"  value="{{ $brand->nama }}" aria-describedby="emailHelp">
              <span style="color : red">@error('nama') {{ $message }} @enderror</span>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
    </div>
</div>
@endsection
@push('script')

@endpush
