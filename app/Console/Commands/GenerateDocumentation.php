<?php

namespace App\Console\Commands;

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
        $this->warn('USER DOCUMENTATION');

        $user = factory(User::class)->create();
        Auth::setUser($user);

        $this->call(
            "api:generate",
            [
                '--routePrefix' => 'api/v1/*',
//                '--output' => 'storage/app/public/docs/user',
//                '--header' => "Authorization:Bearer $token",
                '--force' => true,
                '--env' => 'documentation',
                '--actAsUserId' => $user->id,
                '--middleware' => "auth:api",
//                '--bindings' => "activity,$activity->id|team,$team->id"

            ]);

        $this->warn('ADMIN DOCUMENTATION');
        $admin = factory(Sysadmin::class)->create();

        $this->call(
            "api:generate",
            [
                '--routePrefix' => 'api/sysadminv1/*',
                '--output' => 'storage/app/public/docs/admin/',
                '--force' => true,
                '--env' => 'production',
            ]);
    }
}