<?php

namespace App\Tables;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    // 照片(一对多)标签(反向关联)
    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
