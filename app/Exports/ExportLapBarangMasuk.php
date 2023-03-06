<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
// use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportLapBarangMasuk implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct(String $awal = null , String $akhir = null)
    {
        $this->awal = $awal;
        $this->akhir  = $akhir;
    }

    public function collection()
    {
        if($this->awal && $this->akhir){
           return DB::table('detail_barang_masuk')
           ->join('barang','barang.id','detail_barang_masuk.id_barang')
           ->whereBetween('detail_barang_masuk.created_at',[$this->awal, $this->akhir])
           ->orderBy('detail_barang_masuk.created_at','desc')
           ->get(array(
            'barang.nama','detail_barang_masuk.jumlah','detail_barang_masuk.subtotal','detail_barang_masuk.created_at'
           ));
        }else{
            return DB::table('detail_barang_masuk')
           ->join('barang','barang.id','detail_barang_masuk.id_barang')
           ->orderBy('detail_barang_masuk.created_at','desc')
           ->limit(5)
           ->get(array(
            'barang.nama','detail_barang_masuk.jumlah','detail_barang_masuk.subtotal','detail_barang_masuk.created_at'
           ));
        }
        // return view('laporan_penyesuaian.index',[
        //     'laporan' => DetailPenyesuaian::all()
        // ]);

    }
    public function headings() : array {
        return [
            'Nama',
            'Jumlah',
            'Subtotal',
            'Tgl'
        ] ;
    }
}
