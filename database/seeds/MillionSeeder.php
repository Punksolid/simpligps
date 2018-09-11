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
        factory(\App\Contact::class,10000)->create();
        factory(\App\Carrier::class,10000)->create();
        factory(\App\Convoy::class,10000)->create();
        factory(\App\Device::class,10000)->create();
//        factory(\App\NotificationType::class,10000)->create();
        factory(\App\Operator::class,10000)->create();
//        factory(\App\Permission::class,10000)->create();
        factory(\App\Trace::class,10000)->create();
        factory(\App\Place::class,10000)->create();
        factory(\App\Trip::class,10000)->create();
        factory(\App\User::class,10000)->create();
    }
}
