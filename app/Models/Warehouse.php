<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Отделение НоваПошты
 *
 * @property float $site_key
 * @property string $short_address
 * @property string $short_address_ru
 * @property string $phone
 * @property string $type_of_warehouse
 * @property int $number
 * @property string $city_ref
 * @property string $city_description
 * @property string $city_description_ru
 * @property string $settlement_ref
 * @property string $settlement_description
 * @property string $settlement_area_description
 * @property string $settlement_regions_description
 * @property string $settlement_type_description
 * @property string $settlement_type_description_ru
 * @property int $longitude
 * @property int $latitude
 * @property bool $post_finance
 * @property string $bicycle_parking
 * @property string $payment_access
 * @property bool $posterminal
 * @property bool $international_shipping
 * @property bool $self_service_workplaces_count
 * @property int $total_max_weight_allowed
 * @property int $place_max_weight_allowed
 * @property array $sending_limitations_on_dimensions
 * @property string $district_code
 * @property string $warehouse_status
 * @property string $warehouse_status_date
 * @property string $category_of_warehouse
 * @property string $direct
 * @property string $region_city
 * @property bool $warehouse_for_agent
 * @property int $max_declared_cost
 * @property array $schedule
 * @property array $delivery
 * @property array $reception
 * @property array $receiving_limitations_on_dimensions
 *
 * @property-read City $city
 * @property-read WarehouseType $type
 */
class Warehouse extends AbstractDescribedModel
{
    protected $table = 'warehouse';

    protected $casts = [
        'sending_limitations_on_dimensions' => 'array',
        'schedule' => 'array',
        'delivery' => 'array',
        'reception' => 'array',
        'receiving_limitations_on_dimensions' => 'array',
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(WarehouseType::class, 'type_of_warehouse', 'ref');
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'ref', 'city_ref');
    }
}
