<?php

namespace App\Console\Commands;

use App\Account;
use App\Traits\MutatesTinkerCommand;
//use Hyn\Tenancy\Contracts\Repositories\WebsiteRepository;
//use Hyn\Tenancy\Database\Connection;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\Console\Exception\RuntimeException;
use Laravel\Tinker\Console\TinkerCommand as TinkerParentCommand;

class TenantTinkerCommand extends TinkerParentCommand
{
//    use MutatesTinkerCommand;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenancy:tinker 
                            { account : The ID of the Account }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tinker inside a Tenant';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
//        $this->websites = app(WebsiteRepository::class);
//        $this->connection = app(Connection::class);

        $this->addArgument('include', 2, 'includes', []);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $account_id = $this->argument('account');
        try {
            $account = Account::findOrFail($account_id);
            $this->connection->set($account);
            $this->info('Running Tinker on account_id: '.$account_id);

            parent::handle();

            $this->connection->purge();
        } catch (ModelNotFoundException $exception) {
            throw new RuntimeException(sprintf('The tenancy account_id=%d does not exist.', $account_id));
        }
    }
}
