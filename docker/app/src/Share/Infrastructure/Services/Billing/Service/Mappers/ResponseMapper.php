<?php
declare(strict_types=1);

namespace App\Share\Infrastructure\Services\Billing\Service\Mappers;

use App\Share\Infrastructure\Services\Billing\Service\Response\BasicResponse;
use Psr\Http\Message\ResponseInterface;

class ResponseMapper
{
    private function build(ResponseInterface $response)
    {
        return json_decode($response->getBody()->__toString(), true);
    }

    public function buildBasicResponse(ResponseInterface $response): BasicResponse
    {
        $build = $this->build($response);
        return new BasicResponse(
            $response->getStatusCode(),
            $build['data'] ?? null,
            $build['message'] ?? null,
            $build['errors'] ?? null,
        );
    }
}