<?php

namespace App\Console\Commands;

use App\Account;
use App\Contact;
use App\License;
use App\Sysadmin;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;

class GenerateDocumentation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trms:documentation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Genera documentacion api, sysadmin y php';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        config(['telescope.enabled' => false]);
        $this->warn('USER DOCUMENTATION');
        $this->account = Account::where("uuid", '01b421a3055f4e9bab1d5a3e186a6149')->first();

        $environment = app(\Hyn\Tenancy\Environment::class);

        $environment->tenant($this->account);


        $user = factory(User::class)->create();
        $contact = factory(Contact::class)->create();
        Auth::setUser($user);

        $this->call(
            "api:generate",
            [
                '--routePrefix' => 'api/v1/*',
//                '--output' => 'storage/app/public/docs/user',
//                '--header' => "Authorization:Bearer $token",
                '--force' => false,
                '--env' => 'documentation',
                '--actAsUserId' => $user->id,
                '--middleware' => "auth:api",
                '--output' => 'storage/app/public/docs/user/',
                '--bindings' => "contact,$contact->id"
            ]
        );

        $this->warn('ADMIN DOCUMENTATION');
        $admin = factory(Sysadmin::class)->create();
        /**
         * Bindings
         */
        $licence = factory(License::class)->create();
        $account = factory(Account::class)->create();
        $this->call(
            "api:generate",
            [
                '--routePrefix' => 'api/sysadmin/v1/*',
                '--output' => 'storage/app/public/docs/admin/',
                '--force' => true,
                '--env' => 'production',
                '--bindings' => "license,$licence->id|account,$account->id"
            ]
        );
    }
}
