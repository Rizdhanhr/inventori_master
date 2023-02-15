@extends('layouts.app1')
@section('title','Profil')
@push('css')

@endpush
@section('content')

<!-- DataTales Example -->

<div class="row">
    <div class="row">

        <!-- Grow In Utility -->
        <div class="col-lg-4">

            <div class="card position-relative">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Profil User</h6>
                </div>
                <div class="card-body">
                    <img class="img-profile rounded-circle"
            src="{{ asset('template') }}/img/undraw_profile.svg" style="max-width:100px; display: block;
            margin-left: auto;
            margin-right: auto;">
            <p style="color : black; text-align:center;" class="p-3 m-0">{{ Auth::user()->name }}</p>
            <div class="form-floating">
                <input type="email" style="color: black;" class="form-control" id="floatingInputGrid" value="{{ Auth::user()->email }}" readonly>
                <label for="floatingInputGrid" style="color:black;">Email</label>
            </div>
            <br>
            @php $user = Auth::user(); @endphp
            <div class="form-floating">
                <input type="text" style="color: black;" class="form-control" id="floatingInputGrid" value="{{ date('d F Y' ,strtotime($user->created_at)) }}" readonly>
                <label for="floatingInputGrid" style="color:black;">Tgl Bergabung</label>
            </div>
            <br>
                </div>
            </div>

        </div>

        <!-- Fade In Utility -->
        <div class="col-lg-8">
            <div class="card position-relative">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Pengaturan</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h6 class="m-0 font-weight-bold text-primary">Edit Profil</h6>
                    </div>
                    <form action="{{ route('user.update',$user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-floating">
                        <input type="email" name="email" style="color: black;" class="form-control @error('email') is-invalid @enderror" id="floatingInputGrid" value="{{ Auth::user()->email }}">
                        <label for="floatingInputGrid" style="color:black;">Email</label>
                        <span style="color:red">@error('email') {{ $message }} @enderror</span>
                    </div>
                    <br>
                    <div class="form-floating">
                        <input type="text" name="name" style="color: black;" class="form-control @error('name') is-invalid @enderror" id="floatingInputGrid" value="{{ Auth::user()->name }}">
                        <label for="floatingInputGrid" style="color:black;">Nama</label>
                        <span style="color:red">@error('name') {{ $message }} @enderror</span>
                    </div>
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                    <div class="mb-3">
                        <h6 class="m-0 font-weight-bold text-primary">Ganti Password</h6>
                    </div>
                    <form action="{{ route('ganti-password') }}" method="POST">
                    @csrf
                    <div class="form-floating form-group">
                        <input type="password" name="current_password" style="color: black;" class="form-control @error('current_password') is-invalid @enderror" id="floatingInputGrid">
                        <label for="floatingInputGrid" style="color:black;">Masukkan Password Lama</label>
                        <span style="color:red">@error('current_password') {{ $message }} @enderror</span>
                    </div>
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
                        <button type="submit"  class="btn btn-primary">Ganti Password</button>
                    </div>
                    </form>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection
@push('script')

@endpush
