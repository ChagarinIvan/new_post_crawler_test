<?php

namespace Tests\Integration\NewPost;

use App\Integration\NewPost\Collectors\NewPostAreasCollector;
use App\Integration\NewPost\NewPostApiHelper;
use App\Models\Area;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Psr\Log\NullLogger;
use Tests\TestCase;

class NewPostAreasCollectorTest extends TestCase
{
    use RefreshDatabase;

    public function testCollect(): void
    {
        Http::fake([
            '*' => Http::response('{"success":true,"data":[{"Ref":"71508128-9b87-11de-822f-000c2965ae0e","AreasCenter":"db5c88b7-391c-11dd-90d9-001a92567626","DescriptionRu":"\u0410\u0420\u041a","Description":"\u0410\u0420\u041a"}],"errors":[],"warnings":[],"info":[],"messageCodes":[],"errorCodes":[],"warningCodes":[],"infoCodes":[]}'),
        ]);

        $collector = new NewPostAreasCollector(new NewPostApiHelper(), new NullLogger());
        $collector->collect();

        $areas = Area::all();
        $this->assertCount(1, $areas);
        $this->assertEquals('71508128-9b87-11de-822f-000c2965ae0e', $areas->get(0)->ref);
    }
}
