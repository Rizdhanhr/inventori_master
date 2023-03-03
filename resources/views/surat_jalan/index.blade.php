@extends('layouts.app1')
@section('title','Surat Jalan')
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Surat Jalan</h1>
    {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Cetak Kategori</a> --}}
</div>


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Surat Jalan</h6>
    </div>
    <div class="card-body">
        <button class="m-0 btn btn-primary" onclick="window.location.href='{{ route('transaksi-keluar.create') }}'" style="float: left;">Tambah Surat Jalan</button>
        <div class="table-responsive">
            <br>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="10%">No</th>
                        <th>No Surat.</th>
                        <th width="15%">Tgl</th>
                        <th>Tujuan</th>
                        <th>Driver</th>
                        <th width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($surat as $row)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $row->no_surat }}</td>
                        <td>{{ date('d F Y',strtotime($row->created_at)) }}</td>
                        <td>{{ $row->pelanggan->nama }}</td>
                        <td>{{ $row->nama }}</td>
                        <td align="center">
                            <form action="{{ route('surat-jalan.destroy',$row->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a type="button"   href="{{ route('cetak-surat',$row->no_surat) }}"  target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-print"></i></a>
                            {{-- <button type="button" onclick="window.location.href=''" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></button> --}}
                            <button type="submit" onclick="deleteConfirm(event)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@push('script')
@once
<script>
        window.deleteConfirm = function (e) {
				e.preventDefault();
				var form = e.target.form;
                Swal.fire({
                    title: 'Apakah anda ingin menghapus surat jalan ini?',
                    text: "Surat akan dibatalkan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Batalkan Surat'
                }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
                })
		}
</script>
@endonce
@endpush
