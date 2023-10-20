<?php

namespace App\Imports;

use App\Models\Suratmasuk;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SuratmasukImport implements WithHeadingRow,ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        return new Suratmasuk([
            'no_surat'=>$row['no_surat'],
            'tgl_surat'=>\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tgl_surat'])->format('Y-m-d'),
            'tgl_masuk'=>\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tgl_masuk'])->format('Y-m-d'),
            'pengirim'=>$row['pengirim'],
            'ringkasan'=>$row['ringkasan'],
            'file_surat'=>$row['file_surat']
        ]);
    }
}
