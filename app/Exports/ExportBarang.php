<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
// use Maatwebsite\Excel\Concerns\WithMapping;


class ExportBarang implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('barang')
               ->join('kategori','kategori.id','barang.id_kategori')
               ->join('brand','brand.id','barang.id_brand')
               ->join('satuan','satuan.id','barang.id_satuan')
               ->where('barang.deleted_at' , NULL)
               ->get(array(
                'barang.nama','barang.kode','kategori.nama as nama_kategori','brand.nama as nama_brand','satuan.nama as nama_satuan','barang.harga_beli','barang.harga_jual'
                ,'barang.stok','barang.stok_minimal','barang.keterangan', 'barang.lokasi'
               ));
    }

    public function headings() : array {
        return [
            'Nama Barang', 'Kode','Kategori','Brand','Satuan','Harga Beli','Harga Jual','Stok','Stok Minimal','Keterangan','Lokasi',
        ] ;
    }
}
