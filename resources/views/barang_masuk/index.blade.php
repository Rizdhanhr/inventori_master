@extends('layouts.app1')
@section('title','Barang Masuk')
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
        <h6 class="m-0 font-weight-bold text-primary">Data Barang Masuk</h6>

    </div>
    <div class="card-body">
        <button class="m-0 btn btn-primary" onclick="window.location.href='{{ route('barang-masuk.create') }}'" style="float: left;">Transaksi Baru</button>

        <div class="table-responsive">
            <br>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="10%">No</th>
                        <th>Nama</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td>1</td>
                        <td>aa</td>
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
                                    <button class="dropdown-item" type="button" onclick="window.location.href=''" >Edit</button>
                                    <button type="submit" onclick="deleteConfirm(event)" class="dropdown-item" >Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>



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
