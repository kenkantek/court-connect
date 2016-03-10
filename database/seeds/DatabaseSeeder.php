<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->call(RoleSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(SurfaceSeeder::class);
        $this->call(ClubsSeeder::class);
        $this->call(CourtsSeeder::class);
    }
}
