<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         factory(\App\User::class)->create([
             'email' => 'punksolid@gmail.com',
             'password' => bcrypt('443rancid.')
         ]);
         factory(\App\Sysadmin::class)->create([
             'email' => 'punksolid@gmail.com',
             'password' => bcrypt('443rancid.')
         ]);
    }
}
