@extends('layouts.app1')
@section('title','Penyesuaian')
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Detail Penyesuaian</h1>
    {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Cetak Kategori</a> --}}
</div>


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detail Penyesuaian {{ $no_penyesuaian }}</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <br>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="10%">No</th>
                        <th>Barang</th>
                        <th width="15%">Stok Tercatat</th>
                        <th width="15%">Stok Aktual</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($detail as $row)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $row->barang->nama }}</td>
                        <td>{{ $row->stok_tercatat }}</td>
                        <td>{{ $row->stok_aktual }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Catatan :</th>
                        <th colspan="4" style="text-align:left">{{ $catatan->catatan }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
@push('script')
@once
<script>

</script>
@endonce
@endpush
