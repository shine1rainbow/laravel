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

    // 店铺一对多员工
    public function staffs()
    {
        return $this->hasMany(Staff::class);
    }

    // 店铺用户一对多反向关联
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 店铺远层一对多菜单
    public function menuCategories()
    {
        return $this->hasManyThrough(MenuCategory::class, MenuType::class);
    }
}
