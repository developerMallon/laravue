<?php

use App\TodoTask;
use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::all()->each(function ($user) {
            $user->todos()->saveMany(
                factory(\App\Todo::class, 10)->make()
            )->each(function ($todo) {
                $todo->tasks()->saveMany(
                    factory(\App\TodoTask::class, 10)->make()
                );
            });
        });
    }
}
