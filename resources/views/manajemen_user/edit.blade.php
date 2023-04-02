@extends('layouts.app1')
@section('title','Edit User')
@push('css')

@endpush
@section('content')
<h1 class="h3 mb-2 text-gray-800">Edit User</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit User</h6>

    </div>
    <div class="card-body">
        <form action="{{ route('manajemen-user.update',$user->id) }}" method="POST">
            @csrf
            @method('PUT')
                    <div class="form-floating form-group">
                        <input type="text" name="nama" style="color: black;" class="form-control @error('nama') is-invalid @enderror" value="{{ $user->name }}" id="floatingInputGrid">
                        <label for="floatingInputGrid" style="color:black;">Masukkan Nama User</label>
                        <span style="color:red">@error('nama') {{ $message }} @enderror</span>
                    </div>
                    <div class="form-floating form-group">
                        <input type="email" name="email" style="color: black;" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}"  id="floatingInputGrid">
                        <label for="floatingInputGrid" style="color:black;">Masukkan Email User</label>
                        <span style="color:red">@error('email') {{ $message }} @enderror</span>
                    </div>
                    <div class="form-floating form-group">
                        <select class="form-select @error('role') is-invalid @enderror" name="role" id="floatingSelect" aria-label="Floating label select example">
                          <option value="0" {{ $user->level == '0' ? 'selected' : '' }}>Admin</option>
                          <option value="2" {{ $user->level == '2' ? 'selected' : '' }}>Gudang</option>
                          <option value="1" {{ $user->level == '1' ? 'selected' : '' }}>Super Admin</option>
                        </select>
                        <label for="floatingSelect">Pilih Role</label>
                        <span style="color:red">@error('role') {{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <button type="submit"  class="btn btn-primary">Submit</button>
                    </div>
                </form>
                        <hr>
                        <h6 class="m-0 font-weight-bold text-primary">Ganti Password</h6>
                    <form action="{{ route('change-password',$user->id) }}" method="POST">
                    @csrf
                    <div class="form-floating form-group">
                        <input type="password" name="new_password" style="color: black;" class="form-control @error('new_password') is-invalid @enderror" id="floatingInputGrid">
                        <label for="floatingInputGrid" style="color:black;">Password Baru</label>
                        <span style="color:red">@error('new_password') {{ $message }} @enderror</span>
                    </div>
                    <div class="form-floating form-group">
                        <input type="password" name="new_confirm_password" style="color: black;" class="form-control @error('new_confirm_password') is-invalid @enderror" id="floatingInputGrid">
                        <label for="floatingInputGrid" style="color:black;">Konfirmasi Password Baru</label>
                        <span style="color:red">@error('new_confirm_password') {{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <button type="submit"  class="btn btn-primary">Update</button>
                    </div>
                </form>
    </div>
</div>
@endsection
@push('script')

@endpush
