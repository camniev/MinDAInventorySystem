<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    //  
    protected $table = "stock_libs";

    use SoftDeletes;
    
    protected $fillable = [
        'stock_code','description','unit','expense_category'
    ];

    public $timestamps = false;
}