<?php

namespace App\Tables;

use App\Tables\Traits\InfoTrait;
use Illuminate\Database\Eloquent\Model;

class MenuType extends Model
{
    use InfoTrait;

    protected $guarded = ['id', 'created_at'];

    // 店铺(一对多)菜单(反向关联)
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    // 获取某个类别下的所有菜(远层一对多)
    public function menus()
    {
        return $this->hasManyThrough(Menu::class, MenuCategory::class);
    }

    // 菜单类别(一对多)菜品分类
    public function menuCategories()
    {
        return $this->hasMany(MenuCategory::class);
    }
}
