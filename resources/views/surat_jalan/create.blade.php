@extends('layouts.app1')
@section('title','Surat Jalan')
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
        <h6 class="m-0 font-weight-bold text-primary">Transaksi Surat Jalan</h6>

    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form class="row g-3" action="{{ route('surat-jalan.store') }}" method="POST">
            @csrf
            <div class="col-md-12">
                <select  onchange="getpelanggan(this.value)" id="pelanggan" class="selectpicker form-control" data-live-search="true">
                    <option selected disabled >Pilih Tujuan</option>
                    @foreach($pelanggan as $b)
                    <option value="{{ $b->id }}" data-tokens="{{ $b->id }}">{{ $b->nama }}</option>
                    @endforeach
                </select>
            </div>
            <input type="hidden" value="{{ $no_trx }}" name="no_trx" readonly>
            <input type="hidden" class="form-control" name="id_pelanggan" id="id_pelanggan" readonly>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Tujuan</label>
                <input type="text" class="form-control @error('id_pelanggan') is-invalid @enderror" name="tujuan" id="tujuan" readonly>
            </div>
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">No Telp</label>
                <input type="number" class="form-control @error('id_pelanggan') is-invalid @enderror" name="no_telp" id="no_telp" readonly>
            </div>
            <div class="col-12">
                <label for="inputAddress" class="form-label">Alamat</label>
                <input type="text" class="form-control @error('id_pelanggan') is-invalid @enderror" name="alamat" id="alamat" readonly>
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Nama Driver</label>
                <input type="text" value="{{ old('nama_driver') }}" name="nama_driver" class="form-control @error('nama_driver') is-invalid @enderror" id="inputEmail4">
            </div>
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">No Hp Driver</label>
                <input type="number" value="{{ old('no_driver') }}" name="no_driver" class="form-control @error('no_driver') is-invalid @enderror" id="inputPassword4">
            </div>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">No Polisi Kendaraan</label>
                <input type="text" value="{{ old('nopol') }}" name="nopol" class="form-control @error('nopol') is-invalid @enderror" id="inputEmail4">
            </div>
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Keterangan</label>
                <input type="text" value="{{ old('keterangan') }}" name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" id="inputPassword4">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary form-control">Simpan</button>
            </div>
        </form>
        <br>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Barang</h6>
    </div>
    <div class="card-body">
        <table class="table table-bordered border-light" style="color: black;">
            <thead>
              <tr>
                <th scope="col" width="8%">#</th>
                <th scope="col" width="30%">Nama</th>
                <th scope="col" width="8%">Jumlah</th>
                <th scope="col" width="27%" >Harga</th>
                <th scope="col">Subtotal</th>
              </tr>
            </thead>
            <tbody>
              @foreach($detail as $row)
              <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $row->barang->nama }}</td>
                <td>{{ $row->jumlah }}</td>
                <td>@currency($row->harga)</td>
                <td>@currency($row->subtotal)</td>
              </tr>
              @endforeach
            </tbody>
          </table>
    </div>
</div>
@endsection

@push('script')
@once
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>

<script>
    function getpelanggan($id){
        $.ajax({
            type : "GET",
            url : "/getpelanggan/" + $id,
            success: function(data){
                $("#id_pelanggan").val(data['id']);
                $("#tujuan").val(data['nama']);
                $("#alamat").val(data['alamat']);
                $("#no_telp").val(data['no_hp']);
            },
    });
    }

</script>
@endonce
@endpush

