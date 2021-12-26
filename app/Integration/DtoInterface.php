<?php

declare(strict_types=1);

namespace App\Integration;

use Illuminate\Database\Eloquent\Model;

interface DtoInterface
{
    public static function fromArray(array $data): self;
    public function extractModel(): Model;
}
