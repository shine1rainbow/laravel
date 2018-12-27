<?php

namespace App\Tables;

use App\Tables\Traits\InfoTrait;
use Illuminate\Database\Eloquent\Model;

class ShopQr extends Model
{
    use InfoTrait;

    protected $guarded = ['id', 'created_at'];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
