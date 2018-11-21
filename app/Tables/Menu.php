<?php

namespace App\Tables;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    // 菜单分类(一对多)菜(反向关联)
    public function MenuCategory()
    {
        return $this->belongsTo(MenuCategory::class);
    }

    // 菜(一对多)菜品规格
    public function menuOptions()
    {
        return $this->hasMany(MenuOption::class);
    }

    // 菜(一对多)配菜
    public function menuAdditions()
    {
        return $this->hasMany(MenuAddition::class);
    }
}
