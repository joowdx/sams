<?php

use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo 'Generating CL1 CL2 CL3 rooms...';
        factory(App\Room::class)->states(['CL1', 'CL2', 'CL3'])->create();
    }
}
