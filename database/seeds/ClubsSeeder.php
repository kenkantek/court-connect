<?php

use App\Models\Contexts\Club;
use Illuminate\Database\Seeder;

class ClubsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clubs')->delete();
        factory(Club::class, 10)->create();
    }
}
