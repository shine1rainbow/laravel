<?php

use Illuminate\Database\Seeder;
use App\Tables as TableModels;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //read shops from json file
        $shopFilePath = __DIR__ . '/../files/shops.json';
        $shopStr = file_get_contents($shopFilePath);
        $shopArr = json_decode($shopStr, true);

        //read menuType from json file
        $menuTypeFilePath = __DIR__ . '/../files/menu_types.json';
        $menuTypeStr = file_get_contents($menuTypeFilePath);
        $menuTypeArr = json_decode($menuTypeStr, true);

        //read menuCategory from json file
        $menuCategoryFilePath = __DIR__ . '/../files/menu_categories.json';
        $menuCategoryStr = file_get_contents($menuCategoryFilePath);
        $menuCategoryArr = json_decode($menuCategoryStr, true);

        try {

            DB::beginTransaction();
            $this->_createShops($shopArr);
            $this->_createMenuType($menuTypeArr);
            $this->_createMenuCategory($menuCategoryArr);
            DB::commit();

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::info('[dbSeed Exception]: ' . $e);

        }
    }

    private function _createShops(array $shopArr)
    {
        foreach ($shopArr as $shop) {
            $list[] = [
                'id' => $shop['id'],
                "restaurant_name" => $shop['restaurant_name'],
                "restaurant_logo" => $shop['restaurant_logo'],
                "restaurant_background" => $shop['restaurant_background'],
                "food_type" => $shop['food_type'],
                "email" => $shop['email'],
                "mobile" => $shop['mobile'],
                "landline" => $shop['landline'],
                "postcode" => $shop['postcode'],
                "address" => $shop['address'],
                "service_charge" => $shop['service_charge'],
                "payment_sequence" => $shop['payment_sequence'],
                "vat_reg_no" => $shop['vat_reg_no'],
                "images" => $shop['images'],
                "introduction" => $shop['introduction'],
                "remind" => $shop['remind'],
                "activity" => $shop['activity'],
                "business_hour" => $shop['business_hour']
            ];
        }

        TableModels\Shop::insert($list);
    }

    private function _createMenuType(array $menuTypeArr)
    {
        foreach ($menuTypeArr as $menuType) {
            $list[] = [
                'id' => $menuType['id'],
                "shop_id" => $menuType['shop_id'],
                "name" => $menuType['name'],
                "order" => $menuType['order'],
                "is_recommend" => $menuType['is_recommend'],
                "is_hot" => $menuType['is_hot'],
                "working_date" => $menuType['working_date'],
                "opening_time" => $menuType['opening_time'],
                "serving_time" => $menuType['serving_time']
            ];
        }

        TableModels\MenuType::insert($list);
    }

    private function _createMenuCategory(array $menuCategoryArr)
    {
        foreach ($menuCategoryArr as $menuCategory) {
            $list[] = [
                'id' => $menuCategory['id'],
                "menu_type_id" => $menuCategory['menu_type_id'],
                "name" => $menuCategory['name'],
                "order" => $menuCategory['order'],
                "introduction" => $menuCategory['introduction'],
                "is_recommend" => $menuCategory['is_recommend'],
                "is_hot" => $menuCategory['is_hot']
            ];
        }

        TableModels\MenuCategory::insert($list);
    }
}
