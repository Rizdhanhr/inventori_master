<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat Jalan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
</br>
    <div class="container-fluid">
        <table  class="table table-bordered border-dark">
            <tbody>
                @forelse ($general as $gr)
                <tr>
                  <th width="30" class="text-center"><h3>Surat Jalan {{ $gr->nama }}</h3></th>
                  <th width="30%" class="text-center" rowspan="3" scope="col"><img src="{{ asset('storage/setting/'.$gr->logo) }}" width="180" height="80"></th>
                </tr>
                <tr>
                  <th width="200" class="text-center"><h5>{{ $gr->alamat }}</h5></th>
                </tr>
                @empty
                <tr>
                    <th width="30" class="text-center"><h3>Surat Jalan</h3></th>
                    <th width="30%" class="text-center" rowspan="3" scope="col"><img src="{{ asset('gambar_barang') }}/no_image.png" width="180" height="80"></th>
                </tr>
                <tr>
                    <th width="200" class="text-center"><h5>Jl. Taman Jambangan Indah</h5></th>
                </tr>
                @endforelse
                <tr>
                  <th class="text-center"><h6>SURAT JALAN #{{ $surat->no_surat }}</h6></th>
                </tr>
          </tbody>
          </table>
    </div>
</br>
    <div class="container-fluid">
        <table class="table table-bordered border-dark">
            <tbody>
              <tr>
                <th width="12%" align="left">Tujuan</th>
                <th width="2" scope="col">:</th>
                <th width="300" align="left">{{ $surat->pelanggan->nama }}</th>
                <th width="40%" rowspan="3" scope="col" class="text-center">{{ $surat->keterangan }}</th>
              </tr>
              <tr>
                <th width="12%" align="left">No.Telepon</th>
                <th width="2" scope="col">:</th>
                <th width="300" align="left">{{ $surat->pelanggan->no_hp }}</th>
              </tr>
              <tr>
                <th width="12%" align="left">Tanggal</th>
                <th width="2" scope="col">:</th>
                <th width="300" align="left">{{ $surat->created_at->format('d-m-Y') }}</th>
              </tr>
            </tbody>
        </table>
    </div>
</br>
    <div class="container-fluid">
        <table class="table table-bordered border-dark">
            <tbody>
              <tr bgcolor="#FFFFFF">
                <th width="1%" scope="col" class="text-center">No</th>
                <th width="10%" scope="col" class="text-center">Nama Barang</th>
                <th width="4%" scope="col" class="text-center">Jumlah</th>
                <th width="3%" scope="col" class="text-center">Satuan</th>
              </tr>
              @foreach ( $detail as $row )
              <tr bgcolor="white">
                <td align="center">{{ $loop->iteration }}</td>
                <td align="center">{{ $row->barang->nama }}</td>
                <td align="center">{{ $row->jumlah }}</td>
                <td align="center">{{ $row->barang->satuan->nama }}</td>
              </tr>
              @endforeach
            </tbody>
        </table>
    </div>
  </br>
  <div class="container-fluid">
    <table class="table table-bordered border-dark">
      <tbody>
        <tr>
        <th width="201" scope="col" class="text-center">Dibuat</th>
        <th width="202" scope="col" class="text-center">Diketahui</th>
        <th width="218" scope="col" class="text-center">Dikirim {{ $surat->nopol }}</th>
        <th width="208" scope="col" class="text-center">Penerima</th>
      </tr>
      <tr>
        <th height="83" scope="row">&nbsp;</th>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <th align="left">Nama : {{ $surat->user->name }}</th>
        <th align="left">Nama :</th>
        <th align="left">Nama : {{ $surat->nama }} / {{ $surat->no_hp }}</th>
        <th align="left">Nama :</th>
      </tr>
      <tr>
        <th align="left">Tanggal : {{ $surat->created_at->format('d-m-Y') }}</th>
        <th align="left">Tanggal :</th>
        <th align="left">Tanggal : </th>
        <th align="left">Tanggal :</th>
      </tr>
    </tbody>
    </table>
  </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script>
  window.print();
</script>
</body>
</html>

