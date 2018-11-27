<?php

use Illuminate\Database\Seeder;
use App\Tables\ShopStatus;

class ShopStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {

            DB::beginTransaction();
            $this->_createTableData();
            DB::commit();

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::info('[dbSeed Exception]: ' . $e);

        }
    }

    /**
     * Create data of table
     */
    private function _createTableData()
    {
        $data = [
            [
                'id' => 1,
                'name' => 'opening',
                'desc' => 'now opening',
            ], [
                'id' => 2,
                'name' => 'closed',
                'desc' => 'now closed',
            ], [
                'id' => 3,
                'name' => 'waiting to approved',
                'desc' => 'waiting to approved',
            ], [
                'id' => 4,
                'name' => 'banned',
                'desc' => 'banned',
            ], [
                'id' => 5,
                'name' => 'not approved',
                'desc' => 'not approved',
            ]
		];

		ShopStatus::insert($data);
    }
}
