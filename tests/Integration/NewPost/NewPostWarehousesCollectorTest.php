<?php

namespace Tests\Integration\NewPost;

use App\Integration\NewPost\Collectors\NewPostWarehousesCollector;
use App\Integration\NewPost\NewPostApiHelper;
use App\Models\Warehouse;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Psr\Log\NullLogger;
use Tests\TestCase;

class NewPostWarehousesCollectorTest extends TestCase
{
    use RefreshDatabase;

    public function testCollect(): void
    {
        Http::fake([
            '*' => Http::response('{"success":true,"data":[{"SiteKey":"10119","Description":"\u0412\u0456\u0434\u0434\u0456\u043b\u0435\u043d\u043d\u044f \u21161: \u0432\u0443\u043b. \u041c. \u0413\u0440\u0443\u0448\u0435\u0432\u0441\u044c\u043a\u043e\u0433\u043e, 3","DescriptionRu":"\u041e\u0442\u0434\u0435\u043b\u0435\u043d\u0438\u0435 \u21161: \u0443\u043b. \u041c. \u0413\u0440\u0443\u0448\u0435\u0432\u0441\u043a\u043e\u0433\u043e, 3","ShortAddress":"\u0417\u0430\u0431\u043e\u043b\u043e\u0442\u0456\u0432, \u041c. \u0413\u0440\u0443\u0448\u0435\u0432\u0441\u044c\u043a\u043e\u0433\u043e, 3","ShortAddressRu":"\u0417\u0430\u0431\u043e\u043b\u043e\u0442\u043e\u0432, \u0413\u0440\u0443\u0448\u0435\u0432\u0441\u043a\u043e\u0433\u043e, 3","Phone":"380800500609","TypeOfWarehouse":"9a68df70-0267-42a8-bb5c-37f427e36ee4","Ref":"39931b80-e1c2-11e3-8c4a-0050568002cf","Number":"1","CityRef":"20982d74-9b6c-11e2-a57a-d4ae527baec3","CityDescription":"\u0417\u0430\u0431\u043e\u043b\u043e\u0442\u0456\u0432 (\u0421\u043d\u044f\u0442\u0438\u043d\u0441\u044c\u043a\u0438\u0439 \u0440-\u043d)","CityDescriptionRu":"\u0417\u0430\u0431\u043e\u043b\u043e\u0442\u043e\u0432 (\u0421\u043d\u044f\u0442\u0438\u043d\u0441\u043a\u0438\u0439 \u0440-\u043d)","SettlementRef":"e717af16-4b33-11e4-ab6d-005056801329","SettlementDescription":"\u0417\u0430\u0431\u043e\u043b\u043e\u0442\u0456\u0432","SettlementAreaDescription":"\u0406\u0432\u0430\u043d\u043e-\u0424\u0440\u0430\u043d\u043a\u0456\u0432\u0441\u044c\u043a\u0430 \u043e\u0431\u043b\u0430\u0441\u0442\u044c","SettlementRegionsDescription":"\u0421\u043d\u044f\u0442\u0438\u043d\u0441\u044c\u043a\u0438\u0439 \u0440-\u043d","SettlementTypeDescription":"\u0441\u0435\u043b\u0438\u0449\u0435 \u043c\u0456\u0441\u044c\u043a\u043e\u0433\u043e \u0442\u0438\u043f\u0443","SettlementTypeDescriptionRu":"\u043f\u043e\u0441\u0435\u043b\u043e\u043a \u0433\u043e\u0440\u043e\u0434\u0441\u043a\u043e\u0433\u043e \u0442\u0438\u043f\u0430","Longitude":"25.284086000000000","Latitude":"48.467503000000000","PostFinance":"1","BicycleParking":"0","PaymentAccess":"0","POSTerminal":"1","InternationalShipping":"1","SelfServiceWorkplacesCount":"0","TotalMaxWeightAllowed":"0","PlaceMaxWeightAllowed":"1000","SendingLimitationsOnDimensions":{"Width":170,"Height":170,"Length":300},"ReceivingLimitationsOnDimensions":{"Width":170,"Height":170,"Length":300},"Reception":{"Monday":"16:45-18:00","Tuesday":"16:45-18:00","Wednesday":"16:45-18:00","Thursday":"16:45-18:00","Friday":"16:45-18:00","Saturday":"16:30-17:00","Sunday":"10:00-15:00"},"Delivery":{"Monday":"08:00-12:00","Tuesday":"08:00-12:00","Wednesday":"08:00-12:00","Thursday":"08:00-12:00","Friday":"08:00-12:00","Saturday":"09:00-12:00","Sunday":"09:00-14:30"},"Schedule":{"Monday":"09:00-19:00","Tuesday":"09:00-19:00","Wednesday":"09:00-19:00","Thursday":"09:00-19:00","Friday":"09:00-18:00","Saturday":"-","Sunday":"10:00-18:00"},"DistrictCode":"\u0421\u043a \u0417\u0430","WarehouseStatus":"Working","WarehouseStatusDate":"2013-04-02 00:00:00","CategoryOfWarehouse":"Branch","Direct":"","RegionCity":"\u0427\u0415\u0420\u041d\u0406\u0412\u0426\u0406","WarehouseForAgent":"1","MaxDeclaredCost":"0","WorkInMobileAwis":"0"}],"errors":[],"warnings":[],"info":{"totalCount":1},"messageCodes":[],"errorCodes":[],"warningCodes":[],"infoCodes":[]}'),
        ]);

        $collector = new NewPostWarehousesCollector(new NewPostApiHelper(), new NullLogger());
        $collector->collect();

        $warehouses = Warehouse::all();
        $this->assertCount(1, $warehouses);
        $this->assertEquals('39931b80-e1c2-11e3-8c4a-0050568002cf', $warehouses->get(0)->ref);
    }
}
