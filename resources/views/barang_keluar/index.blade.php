@extends('layouts.app1')
@section('title','Barang Keluar')
@once
@push('css')

@endpush
@endonce
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Transaksi Barang Masuk</h1>
    {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Cetak Kategori</a> --}}
</div>


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Barang Keluar</h6>

    </div>
    <div class="card-body">
        <button class="m-0 btn btn-primary" onclick="window.location.href='{{ route('transaksi-keluar.create') }}'" style="float: left;">Transaksi Baru</button>
        <div class="table-responsive">
            <br>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="10%">No</th>
                        <th>No Trans.</th>
                        <th>Tgl Keluar</th>
                        <th>Tujuan</th>
                        <th>Jumlah</th>
                        <th width="8%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($barang_keluar as $row)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $row->no_trx }}</td>
                        <td>{{ date('d F Y' ,strtotime($row->tgl_keluar)) }}</td>
                        <td>Pelanggan</td>
                        <td>{{ $row->jumlah }}</td>
                        <td align="center">
                            <button type="button" onclick="window.location.href='{{ route('transaksi-keluar.show',$row->no_trx) }}'" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@once
@push('script')

@endpush
@endonce
