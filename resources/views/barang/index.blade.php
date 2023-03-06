@extends('layouts.app1')
@section('title','Barang')
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Barang</h1>
    <a href="{{ route('export-barang') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Cetak Barang</a>
</div>


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Barang</h6>

    </div>
    <div class="card-body">
        <button class="m-0 btn btn-primary" onclick="window.location.href='{{ route('barang.create') }}'" style="float: left;">Tambah Barang</button>

        <div class="table-responsive">
            <br>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="8%">No</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Brand</th>
                        <th>Satuan</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Stok</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($barang as $b)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $b->nama }}</td>
                        <td>{{ $b->kategori->nama }}</td>
                        <td>{{ $b->brand->nama }}</td>
                        <td>{{ $b->satuan->nama }}</td>
                        <td>@currency($b->harga_beli)</td>
                        <td>@currency($b->harga_jual)</td>
                        <td>{{ $b->stok }}</td>
                        <td>
                            <div class="dropdown mb-4">
                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                   Opsi
                                </button>
                                <div class="dropdown-menu animated--fade-in"
                                    aria-labelledby="dropdownMenuButton">
                                    <form action="" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="dropdown-item" onclick="window.location.href='{{ route('barang.edit',$b->id) }}'" >Edit</button>
                                    <button type="button" class="dropdown-item" onclick="window.location.href='{{ route('barang.show',$b->id) }}'" >Detail</button>
                                    <button type="submit" onclick="deleteConfirm(event)" class="dropdown-item" >Hapus</button>
                                </form>
                                </div>
                            </div>
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
                    title: 'Apakah anda ingin menghapus data ini?',
                    text: "Data akan terhapus!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Hapus!'
                }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
                })
		}
</script>
@endonce
@endpush
