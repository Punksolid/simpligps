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

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public $faker = null;
    public $user;
    public $account;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->faker = Factory::create();

    }

    protected function setUp():void
    {
        parent::setUp();

        $this->withoutMiddleware([LimitSimoultaneousAccess::class, LimitExpiredLicenseAccess::class]);

        $this->user = \factory(User::class)->create();
        $this->actingAs($this->user, "api");

        /***WEBSITE CREATION***/
        if (Account::where("uuid", '01b421a3055f4e9bab1d5a3e186a6149')->exists()) {
            $this->account = Account::where("uuid", '01b421a3055f4e9bab1d5a3e186a6149')->first();
        } else {
            $this->account = new Account();
            $this->account->uuid = "01b421a3055f4e9bab1d5a3e186a6149";
            $this->account->easyname = "unittest_tenant_account";
        }

        app(WebsiteRepository::class)->create($this->account);
        dump($this->account->uuid);
        $this->setWebsiteEnvironment();


    }

    protected function setWebsiteEnvironment(): void
    {
        $environment = app(\Hyn\Tenancy\Environment::class);

        $environment->tenant($this->account);
    }


}
