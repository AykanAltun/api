<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractResponse
{
    protected function success(?array $response = null): JsonResponse
    {
        return new JsonResponse(
            json_encode($response, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
            Response::HTTP_OK,
            ['Content-Type' => 'application/json;'],
            true
        );
    }

    protected function empty(): JsonResponse
    {
        return new JsonResponse();
    }
}