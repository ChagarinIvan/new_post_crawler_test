<?php

declare(strict_types=1);

namespace App\Integration\NewPost\Collectors;

use App\Integration\NewPost\NewPostApiHelper;
use App\Models\WarehouseType;
use Psr\Log\LoggerInterface;

class NewPostWarehousesTypesCollector implements CollectorInterface
{
    public function __construct(
        private NewPostApiHelper $apiHelper,
        private LoggerInterface $logger,
    ) {}

    /**
     * example
     * {
     *   "Ref": "6f8c7162-4b72-4b0a-88e5-906948c6a92f",
     *   "Description": "Parcel Shop",
     *   "DescriptionRu": "Parcel Shop"
     * }
     */
    public function collect(): void
    {
        $this->logger->info('Start collect warehouses types.');
        $types = $this->apiHelper->getWarehousesTypes();
        $this->logger->info("Download {$types->count()} type.");

        $this->logger->info('Start saving warehouses types.');
        $types->each(function (array $typeData) {
            $type = WarehouseType::firstOrNew(['ref' => $typeData['Ref'] ?? '']);
            $type->description_ru = $typeData['DescriptionRu'] ?? '';
            $type->description = $typeData['Description'] ?? '';
            $type->save();
        });

        $this->logger->info('Success saving.');
    }
}
