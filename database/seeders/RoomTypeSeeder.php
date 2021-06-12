<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomTypeSeeder extends Seeder
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
                'id' => '691d47a9-0b36-4366-a516-94ad972b6d90',
                'name' => 'General',
            ],
            [
                'id' => 'f1066d00-a370-4290-91cc-84ee2aca6fa9',
                'name' => 'High Spec',
            ],
            [
                'id' => '78d533d9-1f04-47cd-b7f1-9f186053107a',
                'name' => 'Mac',
            ],
        ];

        DB::table('room_types')->insert($data);
    }
}
