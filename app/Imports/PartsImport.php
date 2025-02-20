<?php

namespace App\Imports;

use App\Models\Part;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PartsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {

        if (empty($row['cht_hub']) || empty($row['contents']) || empty($row['application'])) {
            return null;
        }

        return new Part([
            'part_number' => $row['cht_hub'],
            'contents' => $row['contents'],
            'application' => $row['application'],
            'description' => $row['description']
        ]);
    }
}
