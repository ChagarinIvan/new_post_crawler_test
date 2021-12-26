<?php

declare(strict_types=1);

namespace App\Integration\NewPost\Collectors;

/**
 * Базовый коллектор для получения данных НоваПошты
 */
class NewPostCompositeCollector implements CollectorInterface
{
    /** @var CollectorInterface[]  */
    private const COLLECTORS = [
        NewPostAreasCollector::class, //области
        NewPostCitiesCollector::class, //города с отделениями
        NewPostWarehousesTypesCollector::class, //типы отделений
        NewPostWarehousesCollector::class, //отделения
    ];

    public function collect(): void
    {
        foreach (self::COLLECTORS as $collectorClass) {
            $collector = app($collectorClass);
            $collector->collect();
        }
    }
}
