<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Routing\RouteCollection;
use Route;

class RouteListByColumn extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'route:list_columns {columns?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lista las rutas con las columnas especificadas';

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
        $columns = explode(',', $this->argument('columns'));
        $methods_of_interest = ["GET","POST","PUT","PATCH", "DELETE"];

        $routes_collection = Route::getRoutes($methods_of_interest);
        $all_routes = $routes_collection->get();
        $uris = [];
        $index = 0;
        foreach ($all_routes as $value) {
            foreach ($value->methods as $method){
                if (array_search($method, $methods_of_interest)){
                    $uris[$index]["method"] = $method;
                    $uris[$index]["uri"] = $value->uri;
                }

            }

            $this->line($value->uri);

            $index++;
        }
        $this->table($columns = ["method", "uri"], $uris);


    }
}
