<?php

use App\User;
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
        factory(User::class)->create([
            'first_name' => 'Luiz',
            'last_name' => 'Rodrigues',
            'email' => 'luizcbr@live.com',
            'password' => bcrypt('senha')
        ]);

        factory(User::class, 5)->create();
    }
}
