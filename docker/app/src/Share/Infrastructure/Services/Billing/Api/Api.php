<?php
declare(strict_types=1);


namespace App\Share\Infrastructure\Services\Billing\Api;

use App\Share\Infrastructure\Services\Billing\Contracts\ApiInterface;
use Psr\Http\Message\ResponseInterface;

class Api extends \GuzzleHttp\Client implements ApiInterface
{
    private const string URI_CREATE_ACCOUNT = '/billing/account';

    #[\Override] public function createAccount(string $userId): ResponseInterface
    {
        $headers = [];
        $headers['X-User'] = json_encode(['ulid' => $userId]);

        return $this->post(self::URI_CREATE_ACCOUNT, ['headers' => $headers]);
    }
}