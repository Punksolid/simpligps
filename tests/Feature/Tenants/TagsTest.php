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
        $call->dump();
        $call->assertSee('one');
        $call->assertSee('two');
    }

    public function test_trips_list_with_tags()
    {
        $tag = $this->faker->word;
        $trip = factory(Trip::class)->create([
            'tags' => [$tag, 'two']
        ]);
        $call = $this->getJson('api/v1/trips');
        $call->dump();
        $call->assertSee($tag);

    }
}
