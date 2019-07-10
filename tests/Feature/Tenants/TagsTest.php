<?php

namespace Tests\Feature;

use App\Trip;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Tenants\TestCase;

class TagsTest extends TestCase
{
    public function test_list_all_tags()
    {
        $trip = factory(Trip::class)->create([
            'tags' => ['one', 'two']
        ]);

        $call = $this->getJson('api/v1/tags');
        $call->assertJsonStructure([
            'data' => [
                '*' => [
                    'name',
                    'slug'
                ]
            ]
        ]);
        $call->assertSee('one');
        $call->assertSee('two');
    }
}
