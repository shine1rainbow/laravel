<?php

namespace App\Tables;

use App\Tables\Traits\InfoTrait;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use InfoTrait;

    protected $guarded = ['id', 'created_at'];

    protected $table = 'staffs';

    // 店铺(一对多)员工(反向关联)
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
