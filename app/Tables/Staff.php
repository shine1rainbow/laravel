<?php

namespace App\Tables;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    // 店铺(一对多)员工(反向关联)
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
