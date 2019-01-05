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
         $this->call(CreatePermissionsSeeder::class);
         factory(\App\User::class)->create([
             'email' => 'punksolid@gmail.com',
             'password' => bcrypt('443Rancid.')
         ]);
    }
}
