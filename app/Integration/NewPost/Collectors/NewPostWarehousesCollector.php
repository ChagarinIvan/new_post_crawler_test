<?php

declare(strict_types=1);

namespace App\Integration\NewPost\Collectors;

use App\Integration\NewPost\NewPostApiHelper;
use App\Models\Warehouse;
use Psr\Log\LoggerInterface;

class NewPostWarehousesCollector implements CollectorInterface
{
    public function __construct(
        private NewPostApiHelper $apiHelper,
        private LoggerInterface $logger,
    ) {}

    /**
     * example
     * {
     *   "SiteKey": "10119",
     *   "Description": "Відділення №1: вул. М. Грушевського, 3",
     *   "DescriptionRu": "Отделение №1: ул. М. Грушевского, 3",
     *   "ShortAddress": "Заболотів, М. Грушевського, 3",
     *   "ShortAddressRu": "Заболотов, Грушевского, 3",
     *   "Phone": "380800500609",
     *   "TypeOfWarehouse": "9a68df70-0267-42a8-bb5c-37f427e36ee4",
     *   "Ref": "39931b80-e1c2-11e3-8c4a-0050568002cf",
     *   "Number": "1",
     *   "CityRef": "20982d74-9b6c-11e2-a57a-d4ae527baec3",
     *   "CityDescription": "Заболотів (Снятинський р-н)",
     *   "CityDescriptionRu": "Заболотов (Снятинский р-н)",
     *   "SettlementRef": "e717af16-4b33-11e4-ab6d-005056801329",
     *   "SettlementDescription": "Заболотів",
     *   "SettlementAreaDescription": "Івано-Франківська область",
     *   "SettlementRegionsDescription": "Снятинський р-н",
     *   "SettlementTypeDescription": "селище міського типу",
     *   "SettlementTypeDescriptionRu": "поселок городского типа",
     *   "Longitude": "25.284086000000000",
     *   "Latitude": "48.467503000000000",
     *   "PostFinance": "1",
     *   "BicycleParking": "0",
     *   "PaymentAccess": "0",
     *   "POSTerminal": "1",
     *   "InternationalShipping": "1",
     *   "SelfServiceWorkplacesCount": "0",
     *   "TotalMaxWeightAllowed": "0",
     *   "PlaceMaxWeightAllowed": "1000",
     *   "SendingLimitationsOnDimensions": {
     *     "Width": 170,
     *     "Height": 170,
     *     "Length": 300
     *   },
     *   "ReceivingLimitationsOnDimensions": {
     *     "Width": 170,
     *     "Height": 170,
     *     "Length": 300
     *   },
     *   "Reception": {
     *     "Monday": "16:45-18:00",
     *     "Tuesday": "16:45-18:00",
     *     ...
     *   },
     *   "Delivery": {
     *     "Monday": "08:00-12:00",
     *     ...
     *   },
     *   "Schedule": {
     *     "Saturday": "09:00-18:00",
     *   },
     *   "DistrictCode": "Ск За",
     *   "WarehouseStatus": "Working",
     *   "WarehouseStatusDate": "2013-04-02 00:00:00",
     *   "CategoryOfWarehouse": "Branch",
     *   "Direct": "",
     *   "RegionCity": "ЧЕРНІВЦІ",
     *   "WarehouseForAgent": "1",
     *   "MaxDeclaredCost": "0"
     * }
     */
    public function collect(): void
    {
        $this->logger->info('Start collect warehouses.');
        $warehouses = $this->apiHelper->getWarehouses();

        $count = $warehouses->count();
        $percent = 0;
        $processedCount = 0;

        $this->logger->info("Download {$count} warehouses.");

        $this->logger->info('Start saving warehouses.');
        $warehouses->each(function (array $warehouseData) use (&$percent, &$processedCount, $count) {
            $warehouse = Warehouse::firstOrNew(['ref' => $warehouseData['Ref'] ?? '']);
            $warehouse->description = $warehouseData['Description'] ?? '';
            $warehouse->description_ru = $warehouseData['DescriptionRu'] ?? '';
            $warehouse->site_key = (float)$warehouseData['SiteKey'] ?? 0.0;
            $warehouse->short_address = $warehouseData['ShortAddress'] ?? 0.0;
            $warehouse->short_address_ru = $warehouseData['ShortAddressRu'] ?? '';
            $warehouse->phone = $warehouseData['Phone'] ?? '';
            $warehouse->type_of_warehouse = $warehouseData['TypeOfWarehouse'] ?? '';
            $warehouse->number = (int)$warehouseData['Number'] ?? 0;
            $warehouse->city_ref = $warehouseData['CityRef'] ?? '';
            $warehouse->city_description = $warehouseData['CityDescription'] ?? '';
            $warehouse->city_description_ru = $warehouseData['CityDescriptionRu'] ?? '';
            $warehouse->settlement_ref = $warehouseData['SettlementRef'] ?? '';
            $warehouse->settlement_description = $warehouseData['SettlementDescription'] ?? '';
            $warehouse->settlement_area_description = $warehouseData['SettlementAreaDescription'] ?? '';
            $warehouse->settlement_regions_description = $warehouseData['SettlementRegionsDescription'] ?? '';
            $warehouse->settlement_type_description = $warehouseData['SettlementTypeDescription'] ?? '';
            $warehouse->settlement_type_description_ru = $warehouseData['SettlementTypeDescriptionRu'] ?? '';
            $warehouse->longitude = (int)$warehouseData['Longitude'] ?? 0;
            $warehouse->latitude = (int)$warehouseData['Latitude'] ?? 0;
            $warehouse->post_finance = (bool)$warehouseData['PostFinance'] ?? false;
            $warehouse->bicycle_parking = $warehouseData['BicycleParking'] ?? '';
            $warehouse->payment_access = $warehouseData['PaymentAccess'] ?? '';
            $warehouse->posterminal = (bool)$warehouseData['POSTerminal'] ?? false;
            $warehouse->international_shipping = (bool)$warehouseData['InternationalShipping'] ?? false;
            $warehouse->self_service_workplaces_count = (bool)$warehouseData['SelfServiceWorkplacesCount'] ?? false;
            $warehouse->total_max_weight_allowed = (int)$warehouseData['TotalMaxWeightAllowed'] ?? 0;
            $warehouse->place_max_weight_allowed = (int)$warehouseData['PlaceMaxWeightAllowed'] ?? 0;
            $warehouse->sending_limitations_on_dimensions = (array)$warehouseData['SendingLimitationsOnDimensions'] ?? [];
            $warehouse->width = $warehouseData['Width'] ?? '';
            $warehouse->height = $warehouseData['Height'] ?? '';
            $warehouse->length = $warehouseData['Length'] ?? '';
            $warehouse->district_code = $warehouseData['DistrictCode'] ?? '';
            $warehouse->warehouse_status = $warehouseData['WarehouseStatus'] ?? '';
            $warehouse->warehouse_status_date = $warehouseData['WarehouseStatusDate'] ?? '';
            $warehouse->category_of_warehouse = $warehouseData['CategoryOfWarehouse'] ?? '';
            $warehouse->direct = $warehouseData['Direct'] ?? '';
            $warehouse->region_city = $warehouseData['RegionCity'] ?? '';
            $warehouse->warehouse_for_agent = (bool)$warehouseData['WarehouseForAgent'] ?? false;
            $warehouse->max_declared_cost = (int)$warehouseData['MaxDeclaredCost'] ?? 0;
            $warehouse->schedule = (array)$warehouseData['Schedule'] ?? [];
            $warehouse->delivery = (array)$warehouseData['Delivery'] ?? [];
            $warehouse->reception = (array)$warehouseData['Reception'] ?? [];
            $warehouse->receiving_limitations_on_dimensions = (array)$warehouseData['ReceivingLimitationsOnDimensions'] ?? [];
            $warehouse->save();

            $processedCount++;
            if (($percent + 7) <= round($processedCount / $count * 100)) {
                $percent = round($processedCount / $count * 100);
                $this->logger->info("Process: {$percent}%.");
            }
        });

        $this->logger->info('Success saving.');
    }
}
