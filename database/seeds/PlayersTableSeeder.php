<?php

use App\Models\Auth\User;
use App\Models\Player;
use Illuminate\Database\Seeder;

class PlayersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('players')->delete();
        factory(User::class, 50)->create()->each(function ($user) {
            $role_id = 3;
            $context = 'players';
            $context_id = '';
            $user->roles()->attach($role_id, array(
                'context' => $context,
                'context_id' => $context_id,
            ));
        });

    }
}
