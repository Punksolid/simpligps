<?php

namespace Tests\Tenants;

use App\Account;
use App\Http\Middleware\LimitExpiredLicenseAccess;
use App\Http\Middleware\LimitSimoultaneousAccess;
use App\User;
use Faker\Factory;
use Hyn\Tenancy\Models\Website;

/**
 * Usando el repository al parecer no hace las migraciones automaticas
 */
//use Hyn\Tenancy\Repositories\WebsiteRepository; // repository

/**
 * usando el contract marca
 * Hyn\Tenancy\Exceptions\ModelValidationException : The given data was invalid.
 * */

use Hyn\Tenancy\Contracts\Repositories\WebsiteRepository; // contract

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\CreatesApplication;
use App\Http\Middleware\RefreshPersonalAccessTokenMiddleware;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public $faker = null;
    public $user;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->faker = Factory::create();

    }

    protected function setUp():void
    {
        parent::setUp();

        $this->withoutMiddleware([
            LimitSimoultaneousAccess::class, 
            LimitExpiredLicenseAccess::class,
            RefreshPersonalAccessTokenMiddleware::class            
        ]);
        $event_dispatcher = User::getEventDispatcher();

        User::unsetEventDispatcher();
        $this->user = \factory(User::class)->create();
        User::setEventDispatcher($event_dispatcher);
        $this->actingAs($this->user, "api");

        $this->createOrFindTestAccount();

        $this->setWebsiteEnvironment();

        $this->withHeader('X-Tenant-Id', $this->account->uuid);


    }


}
