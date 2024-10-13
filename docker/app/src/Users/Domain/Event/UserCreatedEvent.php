<?php
declare(strict_types=1);


namespace App\Users\Domain\Event;

use App\Share\Domain\Event\EventInterface;

class UserCreatedEvent implements EventInterface
{
    public function __construct(public string $userId, public string $userName, public ?int $age)
    {
    }
}