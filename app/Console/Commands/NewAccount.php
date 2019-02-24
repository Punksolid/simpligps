<?php

namespace App\Console\Commands;

use App\Account;
use Hyn\Tenancy\Contracts\Repositories\WebsiteRepository;
use Hyn\Tenancy\Models\Website;
use Illuminate\Console\Command;
use Psy\Util\Str;

class NewAccount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trm:new_account {easyname}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Genera nueva cuenta';

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
        $website = new Website();
        app(WebsiteRepository::class)->create($website);

//        dd($website->toArray(), $website->hostnames);
        return response($website);

    }
}
