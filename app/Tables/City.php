<?php

namespace App\Tables;

use App\Tables\Traits\InfoTrait;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use InfoTrait;

    protected $guarded = ['id', 'created_at'];
}
