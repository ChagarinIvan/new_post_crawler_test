<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $ref
 * @property string $description
 * @property string $description_ru
 *
 * @method static static firstOrNew(array $attributes)
 */
abstract class AbstractDescribedModel extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $incrementing = false;

    protected $primaryKey = 'ref';
    protected $keyType = 'string';
    protected $fillable = ['ref'];
}
