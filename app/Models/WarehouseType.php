<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * Тип отделения НовоПошты
 *
 * @property-read Warehouse[]|Collection $warehouses
 */
class WarehouseType extends AbstractDescribedModel
{
    protected $table = 'warehouse_type';

    public function warehouses(): HasMany
    {
        return $this->hasMany(Warehouse::class, 'type_of_warehouse', 'ref');
    }
}
