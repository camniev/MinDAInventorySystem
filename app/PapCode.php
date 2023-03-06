<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PapCode extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
    	'division','respocenter','papcode'
    ];

    public $timestamps = false;
}