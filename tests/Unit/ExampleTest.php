<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    public function test_command_route_list()
    {

        $call = $this->artisan('route:list');

        $call->assertExitCode(0);
    }
}
