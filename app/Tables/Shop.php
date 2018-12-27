<?php

namespace App\Tables;

use App\Tables\Traits\InfoTrait;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use InfoTrait;
    
    protected $guarded = ['id', 'created_at'];

    /**
     * Json2Array
     *
     * @param string $value
     * @return mixed
     */
    public function getImagesAttribute($value)
    {
        return array_filter(explode(",", $value));
    }

    /**
     * Array2json
     *
     * @param array $value
     */
    public function setImagesAttribute(array $value)
    {
        $this->attributes['images'] = implode(",", $value);
    }

    /**
     * Json2Array
     *
     * @param string $value
     * @return mixed
     */
    public function getBusinessHourAttribute($value)
    {
        return json_decode($value, true);
    }

    /**
     * Array2json
     *
     * @param array $value
     */
    public function setBusinessHourAttribute($value)
    {
        $this->attributes['business_hour'] = json_encode($value);
    }

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

    public function shop_qr()
    {
        return $this->hasOne(ShopQr::class);
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
