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
        factory(App\Room::class)->states(['CL1'])->create();
        factory(App\Room::class)->states(['CL2'])->create();
        factory(App\Room::class)->states(['CL3'])->create();
    }
}
