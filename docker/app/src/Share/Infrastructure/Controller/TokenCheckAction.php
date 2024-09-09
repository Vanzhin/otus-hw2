<?php

declare(strict_types=1);

namespace App\Share\Infrastructure\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/auth/token/validate', name: 'api_token_check', methods: ['GET'])]
class TokenCheckAction
{
    public function __invoke(): JsonResponse
    {
        return new JsonResponse();
    }
}
