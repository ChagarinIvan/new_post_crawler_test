<?php

namespace Tests\Feature\Api;

use App\Http\Controllers\Api\GetAreaAction;
use App\Models\Area;
use App\Models\City;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetAreaActionTest extends TestCase
{
    use RefreshDatabase;

    public function testAction(): void
    {
        $area = Area::factory()
            ->has(City::factory()->count(2))
            ->create();

        $response = $this->get(action(GetAreaAction::class, [$area->ref]));

        $response = $response->assertStatus(200)->json();
        $this->assertEquals($response['ref'], $area->ref);
        $this->assertArrayHasKey('cities', $response);
        $this->assertCount(2, $response['cities']);
        $this->assertArrayHasKey('area', $response['cities'][0]);
        $this->assertArrayHasKey('ref', $response['cities'][0]);
        $this->assertArrayHasKey('description', $response['cities'][0]);
    }
}
