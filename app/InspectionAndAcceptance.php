<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InspectionAndAcceptance extends Model
{
    use HasFactory;

    use SoftDeletes;
    
}