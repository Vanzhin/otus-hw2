<?php

declare(strict_types=1);

namespace App\Share\Application\Event;

use App\Share\Domain\Event\EventInterface;

interface EventBusInterface
{
    public function execute(EventInterface ...$event): void;
}
