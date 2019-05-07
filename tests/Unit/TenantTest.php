<?php

namespace Tests\Unit;

use Hyn\Tenancy\Models\Website;
use Hyn\Tenancy\Repositories\WebsiteRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TenantTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_tenant_creation()
    {
        $website = new Website();
        app(WebsiteRepository::class)->create($website);

        $environment = app(\Hyn\Tenancy\Environment::class);

        $environment->tenant($website);

        $this->assertDatabaseHas("roles",[],$this->getConnection()->getDatabaseName());
    }
}
