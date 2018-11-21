<?php

namespace App\Tables;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    // 店铺一对多菜单
    public function menuTypes()
    {
        return $this->hasMany(MenuType::class);
    }
}
