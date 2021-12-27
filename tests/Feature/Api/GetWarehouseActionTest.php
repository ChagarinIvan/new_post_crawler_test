<?php

namespace Tests\Feature\Api;

use App\Http\Controllers\Api\GetWarehouseAction;
use App\Models\Warehouse;
use App\Models\WarehouseType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetWarehouseActionTest extends TestCase
{
    use RefreshDatabase;

    public function testAction(): void
    {
        $warehouseType = WarehouseType::factory()
            ->has(Warehouse::factory()->count(1))
            ->create();

        $warehouse = $warehouseType->warehouses->get(0);
        $response = $this->get(action(GetWarehouseAction::class, [$warehouse->ref]));

        $response = $response->assertStatus(200)->json();
        $this->assertEquals($response['ref'], $warehouse->ref);
        $this->assertEquals($response['sending_limitations_on_dimensions'], $warehouse->sending_limitations_on_dimensions);
        $this->assertArrayHasKey('type', $response);
        $this->assertEquals($warehouseType->ref, $response['type']['ref']);
    }
}
