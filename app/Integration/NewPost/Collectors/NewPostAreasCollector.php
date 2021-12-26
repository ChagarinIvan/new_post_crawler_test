<?php

declare(strict_types=1);

namespace App\Integration\NewPost\Collectors;

use App\Integration\NewPost\NewPostApiHelper;
use App\Models\Area;
use Psr\Log\LoggerInterface;

class NewPostAreasCollector implements CollectorInterface
{
    public function __construct(
        private NewPostApiHelper $apiHelper,
        private LoggerInterface $logger,
    ) {}

    /**
     * example
     * {
     *   "Ref": "71508128-9b87-11de-822f-000c2965ae0e",
     *   "AreasCenter": "db5c88b7-391c-11dd-90d9-001a92567626",
     *   "DescriptionRu": "АРК",
     *   "Description": "АРК"
     * }
     */
    public function collect(): void
    {
        $this->logger->info('Start collect areas.');
        $areas = $this->apiHelper->getAreas();
        $this->logger->info("Download {$areas->count()} areas.");

        $this->logger->info("Start saving areas.");
        $areas->each(function (array $areaData) {
            $area = Area::firstOrNew(['ref' => $areaData['Ref'] ?? '']);
            $area->description = $areaData['Description'] ?? '';
            $area->description_ru = $areaData['DescriptionRu'] ?? '';
            $area->areas_center = $areaData['AreasCenter'] ?? '';
            $area->save();
        });
        $this->logger->info("Success saving.");
    }
}
