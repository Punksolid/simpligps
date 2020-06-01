<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class LogEnvironmentVariables extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deploy:log:environment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Logs the real end configuration variables';

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
        Log::info('Configuration variables for database:', \config('database'));
        Log::info('Configuration variables for telescope:', \config('telescope'));
        Log::info('Configuration variables for permission:', \config('permission'));
        Log::info('Configuration variables for tenancy:', \config('tenancy'));
        Log::info('Configuration variables for cache:', \config('cache'));
        $this->info('These are the configuration variables');
        dump(
            \config('database'),
            \config('telescope'),
            \config('permission'),
            \config('tenancy'),
            \config('cache')
        );

    }
}
