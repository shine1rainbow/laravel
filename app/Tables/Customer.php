<?php

namespace App\Tables;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = ['id', 'created_at'];
}
