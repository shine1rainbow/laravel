<?php

namespace App\Tables;

use App\Tables\Traits\InfoTrait;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use InfoTrait;

    protected $guarded = ['id', 'created_at'];

    /**
     * Json2Array
     *
     * @param string $value
     * @return mixed
     */
    public function getDetailImgAttribute($value)
    {
        return json_decode($value, true);
    }

    /**
     * Array2json
     *
     * @param array $value
     */
    public function setDetailImgAttribute($value)
    {
        $this->attributes['detail_img'] = json_encode($value);
    }

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
