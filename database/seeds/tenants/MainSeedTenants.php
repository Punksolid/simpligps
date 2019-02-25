<?php

use Illuminate\Database\Seeder;

class MainSeedTenants extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CreatePermissionsSeeder::class);
    }
}
