<?php
declare(strict_types=1);


namespace App\Share\Infrastructure\Services\Billing\Contracts;

use Psr\Http\Message\ResponseInterface;

interface ApiInterface
{
    public function createAccount(string $userId): ResponseInterface;
}