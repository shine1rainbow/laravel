<?php

namespace App\Tables;

use Illuminate\Database\Eloquent\Model;

class MenuAddition extends Model
{
    // 菜(一对多)配菜(反向关联)
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
