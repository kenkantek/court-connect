<?php

use App\Models\Contexts\Court;
use Illuminate\Database\Seeder;

class CourtsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courts')->delete();
        factory(Court::class, 200)->create();
    }
}
