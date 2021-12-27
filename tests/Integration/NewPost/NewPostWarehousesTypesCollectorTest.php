<?php

namespace Tests\Integration\NewPost;

use App\Integration\NewPost\Collectors\NewPostWarehousesTypesCollector;
use App\Integration\NewPost\NewPostApiHelper;
use App\Models\WarehouseType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Psr\Log\NullLogger;
use Tests\TestCase;

class NewPostWarehousesTypesCollectorTest extends TestCase
{
    use RefreshDatabase;

    public function testCollect(): void
    {
        Http::fake([
            '*' => Http::response('{"success":true,"data":[{"Ref":"6f8c7162-4b72-4b0a-88e5-906948c6a92f","Description":"Parcel Shop","DescriptionRu":"Parcel Shop"}],"errors":[],"warnings":[],"info":[],"messageCodes":[],"errorCodes":[],"warningCodes":[],"infoCodes":[]}'),
        ]);

        $collector = new NewPostWarehousesTypesCollector(new NewPostApiHelper(), new NullLogger());
        $collector->collect();

        $types = WarehouseType::all();
        $this->assertCount(1, $types);
        $this->assertEquals('6f8c7162-4b72-4b0a-88e5-906948c6a92f', $types->get(0)->ref);
    }
}
