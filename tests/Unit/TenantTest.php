<?php

namespace Tests\Unit;

use App\Account;
use Hyn\Tenancy\Models\Website;
use Hyn\Tenancy\Repositories\WebsiteRepository;
use Illuminate\Support\Str;
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
        $this->markTestIncomplete("Este test es de bajo nivel, buscar como cambiar el validador");
        try {
            $account = Account::make([
                'easyname' => Str::random(16),
                'uuid' => Str::uuid()
            ]);

            app(WebsiteRepository::class)->create($account);
        } catch (\Exception $exception) {
        }

        $environment = app(\Hyn\Tenancy\Environment::class);

        $environment->tenant($account);

        $this->assertDatabaseHas("roles",[],$this->getConnection()->getDatabaseName());
    }
}
