<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @property string $areas_center
 *
 * @property-read City[]|Collection $cities
 */
class Area extends AbstractDescribedModel
{
    protected $table = 'area';

    public function cities(): HasMany
    {
        return $this->hasMany(City::class, 'area', 'ref');
    }
}
