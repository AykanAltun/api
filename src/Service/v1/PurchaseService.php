<?php
declare(strict_types=1);

namespace App\Service\v1;

use App\DTO\v1\OrderDTO;
use App\Persistence\Mysql\Convertor\OrderConvertor;
use App\Persistence\Mysql\Service\OrderPersistenceService;
use App\Request\v1\PurchaseRequest;
use App\Service\v1\Mock\IOSVerification;

class PurchaseService
{
    /**
     * @var IOSVerification
     */
    private IOSVerification $verification;
    /**
     * @var OrderPersistenceService
     */
    private OrderPersistenceService $orderPersistenceService;
    /**
     * @var TokenService
     */
    private TokenService $tokenService;

    public function __construct(
        IOSVerification $verification,
        OrderPersistenceService $orderPersistenceService,
        TokenService $tokenService
    ) {
        $this->verification = $verification;
        $this->orderPersistenceService = $orderPersistenceService;
        $this->tokenService = $tokenService;
    }

    public function purchase(PurchaseRequest $purchaseRequest, string $token): OrderDTO
    {
        $purchaseRequest->setVerificationResponse($this->verification->verify($purchaseRequest->getReceipt()));
        $loginDto = $this->tokenService->decodeToken($token);
        $purchaseRequest->setDevice($loginDto->getDevice());
        $purchaseRequest->setApp($loginDto->getApp());
        $order = $purchaseRequest->toEntity();
        $this->orderPersistenceService->save($order);

        return OrderConvertor::toDto($order);
    }
}
