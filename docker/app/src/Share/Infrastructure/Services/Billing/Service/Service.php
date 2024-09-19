<?php
declare(strict_types=1);


namespace App\Share\Infrastructure\Services\Billing\Service;

use App\Share\Infrastructure\Services\Billing\Contracts\ApiInterface;
use App\Share\Infrastructure\Services\Billing\Contracts\ServiceInterface;
use App\Share\Infrastructure\Services\Billing\Service\Mappers\ResponseMapper;
use App\Share\Infrastructure\Services\Billing\Service\Response\BasicResponse;

class Service implements ServiceInterface
{
    public function __construct(private readonly ApiInterface $api, private readonly ResponseMapper $mapper)
    {
    }

    #[\Override] public function createAccount(string $userId): BasicResponse
    {
        $response = $this->api->createAccount($userId);
        return $this->mapper->buildBasicResponse($response);
    }
}