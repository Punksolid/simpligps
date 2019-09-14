<?php

namespace Tests;

use App\Account;
use App\Setting;
use Hyn\Tenancy\Contracts\Repositories\WebsiteRepository;
use Hyn\Tenancy\Environment;
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

        $environment = app(Environment::class);
        $environment->tenant($this->account);
        if (empty((new Setting)->getWialonToken())){
            $setting_wialon_key = Setting::where('key', 'wialon_key')->first();
            $setting_wialon_key->value = '5dce19710a5e26ab8b7b8986cb3c49e58C291791B7F0A7AEB8AFBFCEED7DC03BC48FF5F8';
            $setting_wialon_key->save();
        }
        $environment->tenant();

    }

    protected function setWebsiteEnvironment(): void
    {
        $this->createOrFindTestAccount();
        $environment = app(Environment::class);

        $environment->tenant($this->account);
    }

    public function setAccount(Account $account)
    {
        $environment = app(Environment::class);

        $environment->tenant($account);
        $this->withHeader('X-Tenant-Id',$account->uuid);
        return $this;
    }

}
