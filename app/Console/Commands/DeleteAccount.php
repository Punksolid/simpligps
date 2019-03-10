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
    protected $signature = 'trm:delete_account {easyname}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Elimina una cuenta';

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
     * @deprecated
     * @return mixed
     */
    public function handle()
    {
        $easyname = $this->argument("easyname");
        $account = Account::where("easyname",$easyname)->first();
            $account->delete();

        \DB::connection("mysql")->statement("DROP DATABASE $easyname;");
        return true;


    }
}
