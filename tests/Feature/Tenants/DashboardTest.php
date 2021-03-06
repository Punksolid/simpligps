<?php

namespace Tests\Feature;

use App\TruckTract;
use Tests\Tenants\TestCase;

class DashboardTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->withoutExceptionHandling();
    }

    public function test_user_can_see_dashboard()
    {
        factory(TruckTract::class)->create();
        $call = $this->getJson('api/v1/dashboard');

        $call->assertJsonStructure([
            'data' => [
                'users',
                'devices'
            ]
        ]);
    }
}
