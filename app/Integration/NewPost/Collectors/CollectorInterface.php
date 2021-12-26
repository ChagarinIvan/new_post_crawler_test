<?php

declare(strict_types=1);

namespace App\Integration\NewPost\Collectors;

interface CollectorInterface
{
    public function collect(): void;
}
