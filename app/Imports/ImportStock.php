<?php

namespace App\Imports;

use App\Stock;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportStock implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Stock([
            //
            'stock_code' => $row[0],
            'description' => $row[1],
            'unit' => $row[2],
            'expense_category' => $row[3],
            'reorderpoint' => '',
        ]);
    }
}
