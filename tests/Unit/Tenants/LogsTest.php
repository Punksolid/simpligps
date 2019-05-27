<?php

namespace Tests\Unit\Tenants;

use Tests\Tenants\TestCase;
use App\Device;
use App\Log;
use DebugBar\Bridge\MonologCollector;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use App\ModelLogHandler;

class LogsTest extends TestCase
{
    public function test_register_a_log_with_monolog()
    {
        $this->markTestIncomplete("Monolog puede ser implementado para tener mas los automaticamente");
        // Create the logger
        $logger = new Logger('testing_channel');
        // Now add some handlers
        $logger->pushHandler(new StreamHandler(storage_path().'/my_app.log', Logger::DEBUG));
        $logger->pushHandler(new ModelLogHandler(new Log, Logger::DEBUG));

        // You can now use your logger
        $logger->info('My logger is now ready');
    }

    public function test_register_a_log_for_a_device()
    {
        $device = factory(Device::class)->create();
        $device->emergency('help');

        $this->assertDatabaseHas('logs', [
            'message' => 'help'
        ], 'tenant');
    }
}
