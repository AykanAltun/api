<?php
declare(strict_types=1);

namespace App\Service\v1;

class SubscriptionService
{
    /**
     * @var TokenService
     */
    private TokenService $tokenService;

    public function __construct(TokenService $tokenService)
    {
        $this->tokenService = $tokenService;
    }

    /**
     * OrderStatus güncellendiğinde token yenileneceği varsayılarak yapılmıştır.
     * @param string $token
     * @return string
     */
    public function getSubscriptionStatus(string $token): string
    {
        return ($this->tokenService->decodeToken($token))->getStatus();
    }
}
