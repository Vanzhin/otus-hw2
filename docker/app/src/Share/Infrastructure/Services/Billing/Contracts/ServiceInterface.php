<?php
declare(strict_types=1);


namespace App\Share\Infrastructure\Services\Billing\Contracts;

use App\Share\Infrastructure\Services\Billing\Service\Response\BasicResponse;

interface ServiceInterface
{
    public function createAccount(string $userId): BasicResponse;
}