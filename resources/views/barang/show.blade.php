@extends('layouts.app1')
@section('title','Detail Barang')
@push('css')
@once
    <style>
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
@endonce
@endpush
@section('content')
<h1 class="h3 mb-2 text-gray-800">Detail Barang</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detail Barang</h6>
    </div>
    <div class="card-body">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Standard</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Advance</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <br>
                <label for="Nama Barang" class="form-label mb-6">Kode Barang</label>
                <div class="input-group mb-3">
                    <input type="text" style="color :black;" readonly class="form-control" id="floatingPlaintextInput"  value="{{ $barang->kode }}">
                </div>
                <div class="mb-3">
                    <label for="Nama Barang" class="form-label">Nama Barang</label>
                    <input type="text" style="color :black;" readonly class="form-control" id="floatingPlaintextInput"  value="{{ $barang->nama }}">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Kategori</label>
                    <input type="text" style="color :black;" readonly class="form-control" id="floatingPlaintextInput"  value="{{ $barang->kategori->nama }}">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Satuan</label>
                    <input type="text" style="color :black;" readonly class="form-control" id="floatingPlaintextInput"  value="{{ $barang->satuan->nama }}">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label ">Brand</label>
                    <input type="text" style="color :black;" readonly class="form-control" id="floatingPlaintextInput"  value="{{ $barang->brand->nama }}">
                </div>
                <div class="mb-3">
                    <label for="Nama Barang" class="form-label">Stok</label>
                    <input type="text" style="color :black;" readonly class="form-control" id="floatingPlaintextInput"  value="{{ $barang->stok }}">
                </div>
                <div class="mb-3">
                    <label for="Nama Barang" class="form-label">Stok Minimal</label>
                    <input type="text" style="color :black;" readonly class="form-control" id="floatingPlaintextInput"  value="{{ $barang->stok_minimal }}">
                </div>
                <div class="mb-3">
                    <label for="Nama Barang" class="form-label">Harga Beli</label>
                    <input type="text" style="color :black;" readonly class="form-control" id="floatingPlaintextInput"  value="@currency($barang->harga_beli)">
                </div>
                <div class="mb-3">
                    <label for="Nama Barang" class="form-label">Harga Jual</label>
                    <input type="text" style="color :black;" readonly class="form-control" id="floatingPlaintextInput"  value="@currency($barang->harga_jual)">
                </div>
                <button type="button" onclick="window.location.href='{{ url('barang') }}'" class="btn btn-danger">Kembali</button>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <br>
        <div class="mb-3">
            <label for="Nama Barang" class="form-label">Keterangan</label>
            <input type="text" style="color :black;" readonly class="form-control" id="floatingPlaintextInput"  value="{{ $barang->keterangan }}">
        </div>
        <div class="mb-3">
            <label for="Nama Barang" class="form-label">Lokasi</label>
            <input type="text" style="color :black;" readonly class="form-control" id="floatingPlaintextInput"  value="{{ $barang->lokasi }}">
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Gambar</label>
            <br>
            @if($barang->gambar)
            <!-- Trigger the Modal -->
            <img id="myImg" src="{{ asset($barang->gambar) }}" alt="{{ $barang->nama }}" style="width:100%;max-width:300px">
            <!-- The Modal -->
            <div id="myModal" class="modal">
            <!-- The Close Button -->
            <span class="close">&times;</span>
            <!-- Modal Content (The Image) -->
            <img class="modal-content" id="img01">
            @else
            <img id="myImg" src="{{ asset('gambar_barang') }}/no_image.png" alt="" style="width:100%;max-width:300px">
             <!-- The Modal -->
             <div id="myModal" class="modal">
                <!-- The Close Button -->
                <span class="close">&times;</span>
                <!-- Modal Content (The Image) -->
                <img class="modal-content" id="img01">
            @endif
            </div>
          </div>
        <button type="button" onclick="window.location.href='{{ url('barang') }}'" class="btn btn-danger">Kembali</button>
        </div>
</div>
    </div>
</div>


@endsection

@push('script')
    @once
    <script>
                // Get the modal
        var modal = document.getElementById("myModal");
        // Get the image and insert it inside the modal - use its "alt" text as a caption
        var img = document.getElementById("myImg");
        var modalImg = document.getElementById("img01");
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
    @endonce
@endpush
