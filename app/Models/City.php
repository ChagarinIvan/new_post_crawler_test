<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * Города, где есть отделения НовоПошты
 *
 * @property bool $delivery_1
 * @property bool $delivery_2
 * @property bool $delivery_3
 * @property bool $delivery_4
 * @property bool $delivery_5
 * @property bool $delivery_6
 * @property bool $delivery_7
 * @property string $area
 * @property string $settlement_type
 * @property bool $is_branch
 * @property string|null $prevent_entry_new_streets_user
 * @property string $conglomerates
 * @property int $city_id
 * @property string $settlement_type_description_ru
 * @property string $settlement_type_description
 *
 * @property-read Area $areaModel
 * @property-read Warehouse[]|Collection $warehouses
 */
class City extends AbstractDescribedModel
{
    protected $table = 'city';

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class, 'area', 'ref');
    }

    public function warehouses(): HasMany
    {
        return $this->hasMany(Warehouse::class, 'city_ref', 'ref');
    }
}
