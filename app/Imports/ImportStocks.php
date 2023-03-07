<?php

namespace App\Imports;

use App\StockLib;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportStocks implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new StockLib([
            //
        ]);
    }
}
