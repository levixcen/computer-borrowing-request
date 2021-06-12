<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComputerSeeder extends Seeder
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
                'id' => '26907cc8-dd01-4d3c-b6e3-6b8b1c317b4e',
                'room_id' => '791da6b9-5fd4-422b-94ca-369ff174e844',
                'hostname' => 'BN60201',
                'ip_address' => '192.168.102.101',
                'available' => true,
            ],
            [
                'id' => '2f5065f7-05ed-43ae-8d67-41e870a23a30',
                'room_id' => '791da6b9-5fd4-422b-94ca-369ff174e844',
                'hostname' => 'BN60202',
                'ip_address' => '192.168.102.102',
                'available' => false,
            ],
            [
                'id' => 'f0e2b767-0ef0-4f65-8f46-6c6b25d0dfa6',
                'room_id' => '8d074aff-156e-4589-8b34-b9358d8cfb37',
                'hostname' => 'BN60401',
                'ip_address' => '192.168.104.101',
                'available' => true,
            ],
            [
                'id' => 'aecd0cc4-3077-4d81-99bf-74e9ead0183c',
                'room_id' => '4214be50-1234-4658-b5a4-8c183f614509',
                'hostname' => 'BN70601',
                'ip_address' => '192.168.206.101',
                'available' => true,
            ],
            [
                'id' => 'f181e8a6-b989-4547-9b60-68ad04f68329',
                'room_id' => '4214be50-1234-4658-b5a4-8c183f614509',
                'hostname' => 'BN70602',
                'ip_address' => '192.168.206.102',
                'available' => true,
            ],
            [
                'id' => '4db37c0e-0845-434b-b0d6-d8f6f547c270',
                'room_id' => '6aa54ffa-a14e-4b11-9617-751d1e197c49',
                'hostname' => 'BN711A01',
                'ip_address' => '192.168.211.101',
                'available' => false,
            ],
            [
                'id' => '6b6bb1dc-2022-4aa6-a343-9a479202009d',
                'room_id' => '6aa54ffa-a14e-4b11-9617-751d1e197c49',
                'hostname' => 'BN711A02',
                'ip_address' => '192.168.211.102',
                'available' => true,
            ],
        ];

        DB::table('computers')->insert($data);
    }
}
