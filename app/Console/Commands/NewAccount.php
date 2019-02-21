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

        dd($website->toArray(), $website->hostnames);
//        $easyname = $this->argument("easyname");
//        $validator = \Validator::make([
//            "easyname" => $easyname
//        ], [
//            "easyname" => "required|string|alpha_dash"
//        ]);
//
//        abort_if($validator->fails(), "Ese nombre no es valido, solo alfanumericos");
//
//
//        if (\DB::connection("mysql")->statement("CREATE DATABASE $easyname")) {
//            $default = \Config::get("database.connections.mysql");
//            $default["database"] = $easyname;
//            \Config::set("database.connections.temporal", $default);
//            $connection = \DB::connection("temporal");
//
//            $this->call("migrate", [
//                "--database" => "temporal"
//            ]);
//
//            \Config::set("database.default", "mysql");
//
//        }

    }
}
