<?php

namespace Tests\Feature\Api;

use App\Http\Controllers\Api\GetCityAction;
use App\Models\Area;
use App\Models\City;
use App\Models\Warehouse;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetCityActionTest extends TestCase
{
    use RefreshDatabase;

    public function testAction(): void
    {
        $area = Area::factory()
            ->has(
                City::factory()
                    ->has(Warehouse::factory()->count(2))
                    ->count(1)
            )
            ->create();

        $city = $area->cities->get(0);
        $response = $this->get(action(GetCityAction::class, [$city->ref]));

        $response = $response->assertStatus(200)->json();
        $this->assertEquals($response['ref'], $city->ref);
        $this->assertEquals($response['area'], $area->ref);
        $this->assertArrayHasKey('warehouses', $response);
        $this->assertCount(2, $response['warehouses']);
        $this->assertArrayHasKey('city_ref', $response['warehouses'][0]);
        $this->assertArrayHasKey('ref', $response['warehouses'][0]);
        $this->assertArrayHasKey('description', $response['warehouses'][0]);
    }
}
