<?php

namespace Tests\Feature\Api;

use App\Http\Controllers\Api\GetAreasListAction;
use App\Models\Area;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetAreasListActionTest extends TestCase
{
    use RefreshDatabase;

    public function testAction(): void
    {
        Area::factory()->count(2)->create();

        $response = $this->get(action(GetAreasListAction::class));
        $response->assertStatus(200)
            ->assertJsonStructure(['*' => ['ref', 'description']]);
    }
}
