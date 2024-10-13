<?php

namespace App\Share\Domain\Aggregate;

use App\Share\Domain\Service\UlidService;

class Id
{
    public static function makeUlid(): string
    {
        return UlidService::generate();
    }
}
