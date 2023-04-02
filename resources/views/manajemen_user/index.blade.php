@extends('layouts.app1')
@section('title','Manajemen User')
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Manajemen User</h1>
</div>


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data User</h6>

    </div>
    <div class="card-body">
        <button class="m-0 btn btn-primary" onclick="window.location.href='{{ route('manajemen-user.create') }}'" style="float: left;">Tambah User</button>
        <div class="table-responsive">
            <br>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="10%">No</th>
                        <th>Nama</th>
                        <th width="30%">Email</th>
                        <th>Role</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $k )
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $k->name }}</td>
                        <td>{{ $k->email }}</td>
                        <td>
                            @if($k->level == 1)
                            <span class="badge text-bg-warning">Super Admin</span>
                            @elseif ($k->level == 2)
                            <span class="badge text-bg-primary">Gudang</span>
                            @else
                            <span class="badge text-bg-success">Admin</span>
                            @endif
                        </td>
                        <td>
                            <div class="dropdown mb-4">
                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                   Opsi
                                </button>
                                <div class="dropdown-menu animated--fade-in"
                                    aria-labelledby="dropdownMenuButton">
                                    <form action="{{ route('manajemen-user.destroy',$k->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="dropdown-item" type="button" onclick="window.location.href='{{ route('manajemen-user.edit',$k->id) }}'" >Edit</button>
                                    {{-- <button class="dropdown-item" type="button" onclick="window.location.href='{{ route('manajemen-user.show',$k->id) }}'" >Detail</button> --}}
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
