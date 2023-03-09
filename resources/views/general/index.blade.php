@extends('layouts.app1')
@section('title','General Setting')
@once
@push('css')
<style>
    /* Style the Image Used to Trigger the Modal */
#myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (Image) */
.modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

/* Caption of Modal Image (Image Text) - Same Width as the Image */
#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

/* Add Animation - Zoom in the Modal */
.modal-content, #caption {
  animation-name: zoom;
  animation-duration: 0.6s;
}

@keyframes zoom {
  from {transform:scale(0)}
  to {transform:scale(1)}
}

/* The Close Button */
.close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}
</style>
@endpush
@endonce
@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">General Setting</h6>

    </div>
    <div class="card-body">
        <!-- Trigger the Modal -->
        {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif --}}
        @forelse ( $general as $g )
        <img id="myImg" src="{{ asset('storage/setting/'.$g->logo) }}" alt="Logo" style="width:100%; width:300px; height:200px;">

        <!-- The Modal -->
        <div id="myModal" class="modal">

        <!-- The Close Button -->
        <span class="close">&times;</span>

        <!-- Modal Content (The Image) -->
        <img class="modal-content" id="img01">

        <!-- Modal Caption (Image Text) -->
        <div id="caption"></div>
        </div>

        <form action="{{ route('general-setting.update',$g->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <br>
        <div class="mb-3">
            <label for="formFile" class="form-label">Logo</label>
            <input class="form-control @error('logo') is-invalid @enderror" name="logo" type="file" id="formFile">
            <span style="color:red">@error('logo') {{ $message }} @enderror</span>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nama Perusahaan</label>
            <input type="text" class="form-control @error('nama') is-invalid @enderror" value="{{ $g->nama }}" name="nama" id="exampleFormControlInput1">
            <span style="color:red">@error('nama') {{ $message }} @enderror</span>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Alamat Perusahaan</label>
            <input type="text" class="form-control  @error('alamat') is-invalid @enderror" value="{{ $g->alamat }}" name="alamat" id="exampleFormControlInput1">
            <span style="color:red">@error('alamat') {{ $message }} @enderror</span>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">No Telp</label>
            <input type="number" class="form-control  @error('no_telp') is-invalid @enderror" value="{{ $g->no_telp }}" name="no_telp" id="exampleFormControlInput1">
            <span style="color:red">@error('no_telp') {{ $message }} @enderror</span>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        </form>
        @empty
        <img id="myImg" src="{{ asset('gambar_barang') }}/no_image.png" alt="Logo" style="width:100%; width:300px; height:200px;">

        <!-- The Modal -->
        <div id="myModal" class="modal">

        <!-- The Close Button -->
        <span class="close">&times;</span>

        <!-- Modal Content (The Image) -->
        <img class="modal-content" id="img01">

        <!-- Modal Caption (Image Text) -->
        <div id="caption"></div>
        </div>
        <form action="{{ route('general-setting.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="formFile" class="form-label">Logo</label>
            <input class="form-control @error('logo') is-invalid @enderror" name="logo" type="file" id="formFile">
            <span style="color:red">@error('logo') {{ $message }} @enderror</span>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nama Perusahaan</label>
            <input type="text" class="form-control  @error('nama') is-invalid @enderror" value="{{ old('nama') }}" name="nama" id="exampleFormControlInput1">
            <span style="color:red">@error('nama') {{ $message }} @enderror</span>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Alamat Perusahaan</label>
            <input type="text" class="form-control  @error('alamat') is-invalid @enderror" value="{{ old('alamat') }}"  name="alamat" id="exampleFormControlInput1">
            <span style="color:red">@error('alamat') {{ $message }} @enderror</span>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">No Telp</label>
            <input type="text" class="form-control  @error('no_telp') is-invalid @enderror" value="{{ old('no_telp') }}" name="no_telp" id="exampleFormControlInput1">
            <span style="color:red">@error('no_telp') {{ $message }} @enderror</span>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        </form>
        @endforelse

    </div>
</div>
@once
@push('script')
<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById("myImg");
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");
    img.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
    }

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
    modal.style.display = "none";
}
</script>
@endpush
@endonce
@endsection
