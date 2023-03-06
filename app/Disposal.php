<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Disposal extends Model
{
    //
    use SoftDeletes;

    protected $table = "disposals";

    public $timestamps = false;
}
