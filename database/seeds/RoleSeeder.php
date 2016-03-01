<?php

use App\Models\Auth\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();
        Role::insert(
            [
                [
                    'id' => 2,
                    'name' => 'admin',
                    'label' => 'Administrator',
                ],
                [
                    'id' => 3,
                    'name' => 'user',
                    'label' => 'User',
                ],
                [
                    'id' => 4,
                    'name' => 'player',
                    'label' => 'Player',
                ],
            ]
        );
    }
}
