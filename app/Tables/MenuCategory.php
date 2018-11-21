<?php

namespace App\Tables;

use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    // 菜单类别(一对多菜品分类(反向关联)
    public function menuType()
    {
        return $this->belongsTo(MenuType::class);
    }

    // 菜单分类(一对多)菜
    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}
