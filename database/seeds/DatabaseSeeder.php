<?php

use App\Sysadmin;
use App\User;
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
         factory(User::class)->create([
             'email' => 'punksolid@gmail.com',
             'password' => bcrypt('443rancid.')
         ]);
         factory(Sysadmin::class)->create([
             'email' => 'punksolid@gmail.com',
             'password' => bcrypt('443rancid.')
         ]);
         factory(Sysadmin::class)->create([
             'email' => 'mmachado53@gmail.com',
             'password' => bcrypt('soymarica53.#')
         ]);

         Artisan::call("passport:install");
    }
}
