<?php

use Illuminate\Database\Seeder;

class MillionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Contact::class,1000)->create();
    }
}
