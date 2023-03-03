@extends('layouts.app1')
@section('title','Laporan Barang Keluar')
@once
@push('css')

@endpush
@endonce
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Laporan Barang Keluar</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Cetak Laporan</a>
</div>


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Laporan Barang Keluar</h6>
    </div>
    <div class="card-body">

        <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="float: left;"><i class="fa fa-filter"></i> Filter Laporan</button>
        <div class="table-responsive">
            <br>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="10%">No</th>
                        <th>Nama</th>
                        <th width="10%">Jumlah</th>
                        <th>Subtotal</th>
                        <th width="15%">Tgl</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($laporan as $lap )
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $lap->barang->nama }}</td>
                        <td>{{ $lap->jumlah }}</td>
                        <td>@currency($lap->subtotal)</td>
                        <td>{{ $lap->created_at->format('d-m-Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Filter Laporan Barang Keluar</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="{{ route('laporan-barang-keluar.index') }}" method="GET">
            @csrf
            <div class="form-floating mb-3">
                <input type="date" name="awal" class="form-control" id="floatingInput">
                <label for="floatingInput">Tgl Awal</label>
              </div>
              <div class="form-floating">
                <input type="date" name="akhir" class="form-control" id="floatingPassword">
                <label for="floatingPassword">Tgl Akhir</label>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Proses</button>
        </div>
        </form>
      </div>
    </div>
  </div>
@endsection
@once
@push('script')

@endpush
@endonce
