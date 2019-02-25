<?php

namespace Tests\Tenants;

use App\Account;
use App\Http\Middleware\LimitExpiredLicenseAccess;
use App\Http\Middleware\LimitSimoultaneousAccess;
use App\User;
use Faker\Factory;
use Hyn\Tenancy\Models\Website;
use Hyn\Tenancy\Repositories\WebsiteRepository;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\CreatesApplication;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public $faker = null;
    public $user;
    public $account;
    public $website;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->faker = Factory::create();

    }

    protected function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->withoutMiddleware([LimitSimoultaneousAccess::class, LimitExpiredLicenseAccess::class]);

        $this->user = \factory(User::class)->create();
        $this->actingAs($this->user, "api");
        
        /***WEBSITE CREATION***/
        if (Website::where("uuid", '01b421a3055f4e9bab1d5a3e186a6149')->exists()){
            $this->website =Website::where("uuid", '01b421a3055f4e9bab1d5a3e186a6149')->first() ;
        } else {
            $this->website = new Website();
            $this->website->uuid = "01b421a3055f4e9bab1d5a3e186a6149";
        }

        app(WebsiteRepository::class)->create($this->website);

        $this->setWebsiteEnvironment();


    }

    protected function setWebsiteEnvironment(): void
    {
        $environment = app(\Hyn\Tenancy\Environment::class);

        $environment->tenant($this->website);
    }


}
