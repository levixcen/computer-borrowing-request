<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => '791da6b9-5fd4-422b-94ca-369ff174e844',
                'room_type_id' => '691d47a9-0b36-4366-a516-94ad972b6d90',
                'name' => '602',
                'available' => true,
            ],
            [
                'id' => '8d074aff-156e-4589-8b34-b9358d8cfb37',
                'room_type_id' => '691d47a9-0b36-4366-a516-94ad972b6d90',
                'name' => '604',
                'available' => false,
            ],
            [
                'id' => '4214be50-1234-4658-b5a4-8c183f614509',
                'room_type_id' => 'f1066d00-a370-4290-91cc-84ee2aca6fa9',
                'name' => '706',
                'available' => true,
            ],
            [
                'id' => '088c66d7-84b4-4827-b3ce-970aa84ee6ec',
                'room_type_id' => 'f1066d00-a370-4290-91cc-84ee2aca6fa9',
                'name' => '708',
                'available' => false,
            ],
            [
                'id' => '6aa54ffa-a14e-4b11-9617-751d1e197c49',
                'room_type_id' => '78d533d9-1f04-47cd-b7f1-9f186053107a',
                'name' => '711A',
                'available' => true,
            ],
        ];

        DB::table('rooms')->insert($data);
    }
}
