<?php

declare(strict_types=1);

namespace App\Integration\NewPost\Collectors;

use App\Integration\NewPost\NewPostApiHelper;
use App\Models\City;
use Psr\Log\LoggerInterface;

class NewPostCitiesCollector implements CollectorInterface
{
    public function __construct(
        private NewPostApiHelper $apiHelper,
        private LoggerInterface $logger,
    ) {}

    /**
     * example
     * {
     *   "Description": "Агрономічне",
     *   "DescriptionRu": "Агрономичное",
     *   "Ref": "ebc0eda9-93ec-11e3-b441-0050568002cf",
     *   "Delivery1": "1",
     *   "Delivery2": "1",
     *   "Delivery3": "1",
     *   "Delivery4": "1",
     *   "Delivery5": "1",
     *   "Delivery6": "0",
     *   "Delivery7": "0",
     *   "Area": "71508129-9b87-11de-822f-000c2965ae0e",
     *   "SettlementType": "563ced13-f210-11e3-8c4a-0050568002cf",
     *   "IsBranch": "0",
     *   "PreventEntryNewStreetsUser": null,
     *   "Conglomerates": null,
     *   "CityID": "890",
     *   "SettlementTypeDescriptionRu": "село",
     *   "SettlementTypeDescription": "село"
     * }
     */
    public function collect(): void
    {
        $this->logger->info('Start collect cities.');
        $cities = $this->apiHelper->getCities();
        $count = $cities->count();
        $percent = 0;
        $processedCount = 0;
        $this->logger->info("Download {$count} cities.");

        $this->logger->info("Start saving cities.");
        $cities->each(function (array $cityData) use (&$percent, &$processedCount, $count) {
            $city = City::firstOrNew(['ref' => $cityData['Ref'] ?? '']);
            $city->description = $cityData['Description'] ?? '';
            $city->description_ru = $cityData['DescriptionRu'] ?? '';
            $city->delivery_1 = (bool)$cityData['Delivery1'] ?? false;
            $city->delivery_2 = (bool)$cityData['Delivery2'] ?? false;
            $city->delivery_3 = (bool)$cityData['Delivery3'] ?? false;
            $city->delivery_4 = (bool)$cityData['Delivery4'] ?? false;
            $city->delivery_5 = (bool)$cityData['Delivery5'] ?? false;
            $city->delivery_6 = (bool)$cityData['Delivery6'] ?? false;
            $city->delivery_7 = (bool)$cityData['Delivery7'] ?? false;
            $city->area = $cityData['Area'] ?? '';
            $city->settlement_type = $cityData['SettlementType'] ?? '';
            $city->is_branch = $cityData['IsBranch'] ?? '';
            $city->prevent_entry_new_streets_user = $cityData['PreventEntryNewStreetsUser'] ?? '';
            $city->conglomerates = $cityData['Conglomerates'] ?? '';
            $city->city_id = (int)$cityData['CityID'] ?? 0;
            $city->settlement_type_description_ru = $cityData['SettlementTypeDescriptionRu'] ?? '';
            $city->settlement_type_description = $cityData['SettlementTypeDescription'] ?? '';
            $city->save();

            $processedCount++;
            if (($percent + 8) <= round($processedCount / $count * 100)) {
                $percent = round($processedCount / $count * 100);
                $this->logger->info("Process: {$percent}%.");
            }
        });

        $this->logger->info("Success saving.");
    }
}
