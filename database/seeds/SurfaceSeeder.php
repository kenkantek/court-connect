<?php

use Illuminate\Database\Seeder;

class SurfaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('surface')->delete();
        DB::table('surface')->insert(
            [
                [
                    'id' => 1,
                    'name' => 'porous',
                    'label' => 'Porous',
                ],
                [
                    'id' => 2,
                    'name' => 'natural-grass',
                    'label' => 'Natural Grass',
                ],
                [
                    'id' => 3,
                    'name' => 'hard',
                    'label' => 'Hard',
                ],
            ]
        );
    }
}
