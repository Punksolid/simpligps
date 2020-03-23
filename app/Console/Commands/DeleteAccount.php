<?php

namespace App\Console\Commands;

use App\Account;
use Illuminate\Console\Command;

class DeleteAccount extends Command
{
    //TODO Refactorizar para eliminar base de datos, por que la cuenta se elimina en el controller
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'simpligps:delete_account {uuid}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Elimina una cuenta';

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
     * @deprecated
     *
     * @return mixed
     */
    public function handle()
    {
        $uuid = $this->argument('uuid');
        $account = Account::where('uuid', $uuid)->first();
        $account->delete();

        \DB::connection('mysql')->statement("DROP DATABASE $account->uuid;");

        return true;
    }
}
