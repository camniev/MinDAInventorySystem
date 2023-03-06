<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParCount extends Model
{
    //
    use SoftDeletes;

    protected $fillable = ['year','project_count'];

    public $timestamps = false;
}
