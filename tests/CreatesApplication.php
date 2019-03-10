<?php

namespace Tests;

use App\Account;
use Hyn\Tenancy\Contracts\Repositories\WebsiteRepository;
use Illuminate\Contracts\Console\Kernel;
use Tests\Tenants\TestCase;

trait CreatesApplication
{
    public $account;

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }

    public function createOrFindTestAccount(): void
    {
        /***WEBSITE CREATION***/
        if (Account::where("uuid", '01b421a3055f4e9bab1d5a3e186a6149')->exists()) {
            $this->account = Account::where("uuid", '01b421a3055f4e9bab1d5a3e186a6149')->first();
        } else {
            $this->account = new Account();
            $this->account->uuid = "01b421a3055f4e9bab1d5a3e186a6149";
            $this->account->easyname = "unittest_tenant_account";
        }

        app(WebsiteRepository::class)->create($this->account);
    }

    protected function setWebsiteEnvironment(): void
    {
        $this->createOrFindTestAccount();
        $environment = app(\Hyn\Tenancy\Environment::class);

        $environment->tenant($this->account);
    }

}
