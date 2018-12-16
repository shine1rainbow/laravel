<?php

namespace App\Tables;

use App\Tables\Traits\InfoTrait;
use Illuminate\Database\Eloquent\Model;

class MenuAddition extends Model
{
    use InfoTrait;

    // 菜(一对多)配菜(反向关联)
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
