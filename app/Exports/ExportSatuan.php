<?php

namespace App\Exports;

use App\Models\Satuan;
use Maatwebsite\Excel\Concerns\WithHeadings;
// use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportSatuan implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Satuan::select('nama')->latest()->get();
    }

    public function headings() : array {
        return [
            'Nama Satuan',
        ] ;
    }
}
