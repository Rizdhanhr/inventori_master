<?php

namespace App\Exports;

use App\Models\Brand;
use Maatwebsite\Excel\Concerns\WithHeadings;
// use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportBrand implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Brand::select('nama')->latest()->get();
    }

    public function headings() : array {
        return [
            'Nama Brand',
        ] ;
    }
}
