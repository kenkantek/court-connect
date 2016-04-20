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
                    'name' => 'hard',
                    'label' => 'Hard',
                ],
                [
                    'id' => 2,
                    'name' => 'hartru',
                    'label' => 'Har-Tru',
                ],
                [
                    'id' => 3,
                    'name' => 'redclay',
                    'label' => 'Red Clay',
                ],
                [
                    'id' => 4,
                    'name' => 'grass',
                    'label' => 'Grass',
                ],
                [
                    'id' => 5,
                    'name' => 'carpet',
                    'label' => 'Carpet',
                ],
            ]
        );
    }
}
