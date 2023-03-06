<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Disposal_Detail extends Model
{
    //
    use SoftDeletes;
    
    protected $table = "disposal__details";

}
