@extends('layouts.app1')
@section('title','Edit Barang')
@push('css')

@endpush
@section('content')
<h1 class="h3 mb-2 text-gray-800">Edit Barang</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Barang</h6>
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
        <form action="{{ route('barang.update',$barang->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <br>
                <label for="Nama Barang" class="form-label mb-6">Kode Barang</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control @error('kode') is-invalid @enderror" name="kode" value="{{ $barang->kode }}" id="kode" placeholder="Scan QR Code/Masukkan Kode Bila Ada !" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-primary" type="button" id="button-addon2" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa fa-qrcode"></i></button>
                    <span style="color:red">@error('kode') {{ $message }} @enderror</span>
                </div>
                <div class="mb-3">
                    <label for="Nama Barang" class="form-label">Nama Barang</label>
                    <input type="text" name="nama" value="{{ $barang->nama }}" class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan Nama Barang">
                    <span style="color : red"> @error('nama') {{ $message }} @enderror</span>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Kategori</label>
                    <select class="form-select @error('kategori') is-invalid @enderror" aria-label="Default select example" name="kategori">
                        <option selected disabled>Pilih Kategori</option>
                        @foreach ($kategori as $kat)
                        <option value="{{ $kat->id }}" {{ $kat->id == $barang->id_kategori ? 'selected' : '' }}>{{ $kat->nama }}</option>
                        @endforeach
                      </select>
                      <span style="color : red">@error('kategori') {{ $message }} @enderror</span>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Satuan</label>
                    <select class="form-select @error('satuan') is-invalid @enderror" aria-label="Default select example" name="satuan">
                        <option selected disabled>Pilih Satuan</option>
                        @foreach ($satuan as $sat)
                        <option value="{{ $sat->id }}" {{ $sat->id == $barang->id_satuan ? 'selected' : '' }}>{{ $sat->nama }}</option>
                        @endforeach
                      </select>
                      <span style="color : red">@error('satuan') {{ $message }} @enderror</span>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label ">Brand</label>
                    <select class="form-select @error('brand') is-invalid @enderror" aria-label="Default select example" name="brand">
                        <option selected disabled>Pilih Brand</option>
                        @foreach ($brand as $br)
                        <option value="{{ $br->id }}" {{ $br->id == $barang->id_brand ? 'selected' : '' }}>{{ $br->nama }}</option>
                        @endforeach
                      </select>
                      <span style="color : red">@error('brand') {{ $message }} @enderror</span>
                </div>
                <div class="mb-3">
                    <label for="Nama Barang" class="form-label">Stok</label>
                    <input type="number" name="stok" value="{{ $barang->stok }}" class="form-control @error('stok') is-invalid @enderror" placeholder="Masukkan Stok">
                    <span style="color : red">@error('stok') {{ $message }} @enderror</span>
                </div>
                <div class="mb-3">
                    <label for="Nama Barang" class="form-label">Stok Minimal</label>
                    <input type="number" name="stok_minim" value="{{ $barang->stok_minimal }}" class="form-control @error('stok_minim') is-invalid @enderror" placeholder="Masukkan Stok Minimal">
                    <span style="color : red">@error('stok_minim') {{ $message }} @enderror </span>
                </div>
                <div class="mb-3">
                    <label for="Nama Barang" class="form-label">Harga Beli</label>
                    <input type="number" name="harga_beli" value="{{ $barang->harga_beli }}" class="form-control @error('harga_beli') is-invalid @enderror" placeholder="Masukkan Harga Beli">
                    <span style="color : red"> @error('harga_beli') {{ $message }} @enderror </span>
                </div>
                <div class="mb-3">
                    <label for="Nama Barang" class="form-label">Harga Jual</label>
                    <input type="number" name="harga_jual" value="{{ $barang->harga_jual }}" class="form-control @error('harga_jual') is-invalid @enderror" placeholder="Masukkan Harga Jual">
                    <span style="color : red">@error('harga_jual') {{ $message }} @enderror</span>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" onclick="window.location.href='{{ url('barang') }}'" class="btn btn-danger">Batal</button>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <br>
        <div class="mb-3">
            <label for="Nama Barang" class="form-label">Keterangan</label>
            <input type="text" name="ket" value="{{ $barang->keterangan }}" class="form-control" placeholder="Masukkan Keterangan">
        </div>
        <div class="mb-3">
            <label for="Nama Barang" class="form-label">Lokasi</label>
            <input type="text" name="lokasi" value="{{ $barang->lokasi }}" class="form-control" placeholder="Masukkan Lokasi">
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Masukkan Gambar</label>
            <input class="form-control @error('gambar') is-invalid @enderror" type="file" name="gambar" id="formFile">
            <span style="color : red"> @error('gambar') {{ $message }} @enderror</span>
            <br>
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
        <button type="submit" class="btn btn-primary">Simpan</button>
        <button type="button" onclick="window.location.href='{{ url('barang') }}'" class="btn btn-danger">Batal</button>
        </div>
    </form>
</div>
    </div>
</div>
{{-- Modal Scanner  --}}
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Scan Barcode</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="col-12">
                <div id="reader" width="500px"></div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Understood</button>
        </div>
      </div>
    </div>
  </div>
  {{-- End Modal --}}
@endsection

@push('script')
    @once
    <script>
    function onScanSuccess(decodedText, decodedResult) {
        // Handle on success condition with the decoded text or result.
        console.log(`Scan result: ${decodedText}`, decodedResult);
        $('#kode').val(decodedText);
        $('.modal').each(function(){
            $(this).modal('hide');
        });
        $(function() {
            Swal.fire({
                icon: 'success',
                title: 'Sukses',
                text: 'QR Berhasil Di Scan!',
                timer: 1500,
                timerProgressBar: true
            })
        });
        // html5QrcodeScanner.clear();

    }

    function onScanError(errorMessage) {
        // handle on error condition, with error message
        // $('.modal').each(function(){
        //     $(this).modal('hide');
        // });
        // Swal.fire({
        //     icon: 'error',
        //     title: 'Gagal',
        //     text: 'QR Gagal Discan!',
        //     timer: 1500,
        //     timerProgressBar: true
        // });
    }
    var html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", { fps: 10, qrbox: 250 });
    html5QrcodeScanner.render(onScanSuccess, onScanError);
    </script>

    @endonce
@endpush
