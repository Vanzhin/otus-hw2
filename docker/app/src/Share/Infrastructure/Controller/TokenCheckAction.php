<?php

declare(strict_types=1);

namespace App\Share\Infrastructure\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/auth/token/validate', name: 'api_token_check', methods: ['GET'])]
class TokenCheckAction extends AbstractController
{
    public function __invoke(): JsonResponse
    {
        $response = new JsonResponse();
        $response->headers->add(['X-User' => $this->getUser()->getUlid()]);
        return $response;
    }
}
