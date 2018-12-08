<?php

namespace App\Tables;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    // 照片(一对多)标签
    public function pictures()
    {
        return $this->hasMany(Picture::class);
    }

    // 店铺标签一对多反向关联
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
