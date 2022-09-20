<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockLib extends Model
{
    //
        protected $fillable = [
    	'stock_code','description','unit','expense_category'
    ];
}