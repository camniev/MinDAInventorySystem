<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SignSetting extends Model
{
    //
    use SoftDeletes;

    public $timestamps = false;
}
