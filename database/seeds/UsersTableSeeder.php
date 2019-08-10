<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=App\User::create([
            'name' => 'Vineeth',
            'email' => 'vineethkply@gmail.com',
            'password' => bcrypt('password'),
            'admin'    => 1
        ]);

        App\Profile::create([
            'user_id'  => $user->id,
            'about'    => 'test dhgdhgd dhgdhd dhgdhgd hdhd',
            'facebook' => 'facebook.com',
            'youtube'  => 'youtube.com',
            'avatar'   => 'uploads/avatars/edited.jpg'

        ]);
    }
}
