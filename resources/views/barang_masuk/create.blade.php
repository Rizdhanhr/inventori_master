@extends('layouts.app1')
@section('title','Barang Masuk')
@push('css')
@once
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

@endonce
@endpush
@section('content')
<!-- Page Heading -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Transaksi Barang Masuk</h6>

    </div>
    <div class="card-body">
        <form class="row g-3">
            <div class="input-group mb-3 col-md-6">
                <input type="text" class="form-control" name="kode" id="kode" placeholder="Scan QR Code/Masukkan Kode !" aria-label="Recipient's username" aria-describedby="button-addon2">
                <button class="btn btn-primary" type="button" id="button-addon2" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa fa-qrcode"></i></button>
            </div>
            <div class="col-md-6">
                <select class="selectpicker form-control" data-live-search="true">
                    <option data-tokens="ketchup mustard">Hot Dog, Fries and a Soda</option>
                    <option data-tokens="mustard">Burger, Shake and a Smile</option>
                    <option data-tokens="frosting">Sugar, Spice and all things nice</option>
                </select>
            </div>
        </form>

        <form class="row g-3">
            <div class="col-md-4">
              <label for="inputEmail4" class="form-label">Nama Barang</label>
              <input type="email" class="form-control" id="inputEmail4">
            </div>
            <div class="col-md-3">
              <label for="inputPassword4" class="form-label">Stok</label>
              <input type="password" class="form-control" id="inputPassword4">
            </div>
            <div class="col-md-3">
                <label for="inputPassword4" class="form-label">Jumlah</label>
                <input type="password" class="form-control" id="inputPassword4">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary btn-xs">Tambah</button>
            </div>
        </form>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Keranjang</h6>

    </div>
    <div class="card-body">

    </div>
</div>
@endsection
@push('script')
@once
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>
@endonce
@endpush
