<?php

use App\Models\Auth\Role;
use App\Models\Auth\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        factory(User::class, 100)->create()->each(function ($user) {
            $role_id = Role::all('id')->random(1);
            $context = 'groups';
            $context_id = 1;
            $user->roles()->attach($role_id, array(
                'context' => $context,
                'context_id' => $context_id,
            ));
        });
    }
}
