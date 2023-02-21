@extends('layouts.app1')
@section('title','Barang Masuk')
@push('css')
@once
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

@endonce
@endpush
@section('content')
<!-- Page Heading -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Transaksi Barang Masuk</h6>

    </div>
    <div class="card-body">
        <form class="row g-3">
            <div class="input-group mb-3 col-md-5">
                <input type="text" class="form-control" name="kode" id="kode" placeholder="Scan QR Code/Masukkan Kode !" aria-label="Recipient's username" aria-describedby="button-addon2">
                <button class="btn btn-secondary" type="button"  id="btn-search"><i class="fa fa-search"></i></button>
                <button class="btn btn-primary" type="button" id="button-addon2" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa fa-qrcode"></i></button>

            </div>
            <div class="col-md-1">
                <label for="">Atau</label>
            </div>
            <div class="col-md-6">
                <select class="selectpicker form-control" data-live-search="true">
                    <option selected disabled>Pilih Barang</option>
                    @foreach($barang as $b)
                    <option data-tokens="{{ $b->id }}">{{ $b->nama }}</option>

                    @endforeach
                </select>
            </div>
        </form>
        <br>
        <form class="row g-3">
            <div class="col-md-4">
              <label for="inputEmail4" class="form-label">Nama Barang</label>
              <input type="email" id="nama" class="form-control" id="inputEmail4" readonly>
            </div>
            <div class="col-md-2">
              <label for="inputPassword4"  class="form-label">Stok</label>
              <input type="stok" id="stok" class="form-control" id="inputPassword4" readonly>
            </div>
            <div class="col-md-4">
                <label for="inputPassword4"  class="form-label">Harga</label>
                <input type="harga" id="harga" class="form-control" id="inputPassword4" readonly>
              </div>
            <div class="col-md-2">
                <label for="inputPassword4" class="form-label">Jumlah</label>
                <input type="password" class="form-control">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary btn-xs">Tambah</button>
            </div>
        </form>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Keranjang</h6>

    </div>
    <div class="card-body">
        <table class="table table-bordered border-light" style="color: black;">
            <thead>
              <tr>
                <th scope="col" width="8%">#</th>
                <th scope="col">Nama</th>
                <th scope="col" width="8%">Jumlah</th>
                <th scope="col">Harga</th>
                <th scope="col">Subtotal</th>
                <th scope="col" width="8%">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                <td>Otto</td>
                <td>Otto</td>
              </tr>
              <tr>
                <td colspan="4" align="right" style="color:#000000"><strong> TOTAL HARGA :</strong></td>
                <td colspan="2" align="left"><strong>Rp. 250.000,00</strong></td>
              </tr>
            </tbody>
          </table>
    </div>
</div>

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Scan Barcode</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="col-12">
            <div id="reader" width="600px"></div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

        </div>
      </div>
    </div>
  </div>
  {{-- End Modal --}}
@endsection

@push('script')
@once
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>

<script>
        $("#btn-search").click(function(){
            let kode = $("#kode").val();
                // $("#btn-search").trigger('click');
            $.ajax({
                type : "GET",
                url : "/getbarang/"+ kode,
                data : {kode:kode},
                success: function(response){
                    if (response.msg === 'gagal') {
                    // alert('Data Tidak Ditemukan');
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Data tidak temukan!',
                        timer: 1500,
                        timerProgressBar: true
                    });
                    }else {
                    console.log(response);
                    $("#nama").val(response['nama']);
                    $("#harga").val(response['harga_beli']);
                    $("#stok").val(response['stok']);
                    }
                }
             });
        });

        function onScanSuccess(decodedText, decodedResult) {
        // Handle on success condition with the decoded text or result.
        console.log(`Scan result: ${decodedText}`, decodedResult);
        $('#kode').val(decodedText);
        $('.modal').each(function(){
            $(this).modal('hide');
        });
        $(function() {
            Swal.fire({
                icon: 'success',
                title: 'Sukses',
                text: 'QR Berhasil Di Scan!',
                timer: 1500,
                timerProgressBar: true
            })
        $("#btn-search").trigger('click');
        });
        // html5QrcodeScanner.clear();

    }

    function onScanError(errorMessage) {
        // handle on error condition, with error message
        // $('.modal').each(function(){
        //     $(this).modal('hide');
        // });

        // Swal.fire({
        //     icon: 'error',
        //     title: 'Gagal',
        //     text: 'QR Gagal Discan!',
        //     timer: 1500,
        //     timerProgressBar: true
        // });
    }
    var html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", { fps: 10, qrbox: 250 });
    html5QrcodeScanner.render(onScanSuccess, onScanError);
</script>
@endonce
@endpush

