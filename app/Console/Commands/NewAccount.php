<?php

namespace App\Console\Commands;

use App\Account;
use Hyn\Tenancy\Contracts\Repositories\WebsiteRepository;
use App\Website;
use Illuminate\Console\Command;

class NewAccount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trm:new_account';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Genera nueva cuenta';

    /**
     * Create a new command instance.
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
//        $website = new Website();
        $website = new Account(['easyname' => 'temp_name']);
        app(WebsiteRepository::class)->create($website);

        $this->info('Account Id: '.$website->id);
        $this->info('Uuid: '.$website->uuid);
        sleep(1);
        $this->call('tenancy:db:seed', [
            '--website_id' => ["$website->id"],
            '--class' => 'MainSeedTenants',
        ]);

        return response($website);
    }
}
