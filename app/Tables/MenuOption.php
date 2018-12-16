<?php

namespace App\Tables;

use App\Tables\Traits\InfoTrait;
use Illuminate\Database\Eloquent\Model;

class MenuOption extends Model
{
    use InfoTrait;

    // 菜(一对多)菜品规格(反向关联)
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
