@extends('layouts.app1')
@section('title','Safety Stock')
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Safety Stock</h1>

</div>


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Safety Stock</h6>

    </div>
    <div class="card-body">


        <div class="table-responsive">
            <br>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="10%">No</th>
                        <th>Nama</th>
                        <th>Safety Stock</th>
                        <th>Reorder Point</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ss as $row)
                    @php $safety = ($row->max_harian * 5)-($row->rata * 5); @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $row->nama }}</td>
                        <td>{{  $safety }}</td>
                        <td>{{  ($row->max_harian * 5) + $safety }}</td>
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

@endonce
@endpush
