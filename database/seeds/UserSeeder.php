<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->states('admin')->create();
        factory(App\User::class)->states('g2')->create();
        factory(App\User::class)->states('g1')->create();

    }
}
