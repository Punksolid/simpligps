<?php

namespace Tests\Tenants;

use App\Http\Middleware\IsUserPermittedInAccountMiddleware;
use App\Http\Middleware\LimitExpiredLicenseAccess;
use App\Http\Middleware\LimitSimoultaneousAccess;
use App\Http\Middleware\RefreshPersonalAccessTokenMiddleware;
use App\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\CreatesApplication;

/**
 * Usando el repository al parecer no hace las migraciones automaticas
 */
//use Hyn\Tenancy\Repositories\WebsiteRepository; // repository

/**
 * usando el contract marca
 * Hyn\Tenancy\Exceptions\ModelValidationException : The given data was invalid.
 * */
// contract

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
            RefreshPersonalAccessTokenMiddleware::class,
            IsUserPermittedInAccountMiddleware::class
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
