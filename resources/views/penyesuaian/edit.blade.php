@extends('layouts.app1')
@section('title','Batal Penyesuaian')
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Batalkan Penyesuaian</h1>
    {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Cetak Kategori</a> --}}
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"> Penyesuaian Barang {{ $no_penyesuaian }}</h6>
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
                        <th width="8%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($detail as $row)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $row->barang->nama }}</td>
                        <td>{{ $row->stok_tercatat }}</td>
                        <td>{{ $row->stok_aktual }}</td>
                        <td align="center">
                            <form action="{{ route('penyesuaian.update',$row->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button onclick="deleteConfirm(event)" class="btn btn-danger btn-sm" type="submit"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th  style="text-align:left">Catatan</th>
                        <th colspan="4">{{ $catatan->catatan }}</th>
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
window.deleteConfirm = function (e) {
				e.preventDefault();
				var form = e.target.form;
                Swal.fire({
                    title: 'Apakah anda ingin membatalkan transaksi ini?',
                    text: "Transaksi akan dibatalkan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Batalkan Transaksi'
                }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
                })
		}
</script>
@endonce
@endpush
