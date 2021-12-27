<?php

namespace Tests\Integration\NewPost;

use App\Integration\NewPost\Collectors\NewPostCitiesCollector;
use App\Integration\NewPost\NewPostApiHelper;
use App\Models\City;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Psr\Log\NullLogger;
use Tests\TestCase;

class NewPostCitiesCollectorTest extends TestCase
{
    use RefreshDatabase;

    public function testCollect(): void
    {
        Http::fake([
            '*' => Http::response('{"success":true,"data":[{"Description":"\u0410\u0431\u0440\u0438\u043a\u043e\u0441\u0456\u0432\u043a\u0430","DescriptionRu":"\u0410\u0431\u0440\u0438\u043a\u043e\u0441\u043e\u0432\u043a\u0430","Ref":"6dbe932e-1aad-11ea-8c15-0025b502a06e","Delivery1":"1","Delivery2":"0","Delivery3":"1","Delivery4":"0","Delivery5":"1","Delivery6":"0","Delivery7":"0","Area":"7150813c-9b87-11de-822f-000c2965ae0e","SettlementType":"563ced13-f210-11e3-8c4a-0050568002cf","IsBranch":"0","PreventEntryNewStreetsUser":"0","CityID":"5012","SettlementTypeDescription":"\u0441\u0435\u043b\u043e","SettlementTypeDescriptionRu":"\u0441\u0435\u043b\u043e","SpecialCashCheck":1,"AreaDescription":"\u0425\u0435\u0440\u0441\u043e\u043d\u0441\u044c\u043a\u0430","AreaDescriptionRu":"\u0425\u0435\u0440\u0441\u043e\u043d\u0441\u043a\u0430\u044f"}],"errors":[],"warnings":[],"info":{"totalCount":7717},"messageCodes":[],"errorCodes":[],"warningCodes":[],"infoCodes":[]}'),
        ]);

        $collector = new NewPostCitiesCollector(new NewPostApiHelper(), new NullLogger());
        $collector->collect();

        $cities = City::all();
        $this->assertCount(1, $cities);
        $this->assertEquals('6dbe932e-1aad-11ea-8c15-0025b502a06e', $cities->get(0)->ref);
    }
}
