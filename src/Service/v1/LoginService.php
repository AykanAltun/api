<?php
declare(strict_types=1);

namespace App\Service\v1;

use App\Constant\OrderStatus;
use App\DTO\v1\LoginDTO;
use App\Exception\ApplicationNotFoundException;
use App\Exception\DeviceNotFoundException;
use App\Persistence\Mysql\Service\ApplicationPersistenceService;
use App\Persistence\Mysql\Service\DevicePersistenceService;
use App\Persistence\Mysql\Service\OrderPersistenceService;
use App\Request\v1\LoginRequest;

class LoginService
{
    /**
     * @var ApplicationPersistenceService
     */
    private ApplicationPersistenceService $applicationPersistenceService;
    /**
     * @var DevicePersistenceService
     */
    private DevicePersistenceService $devicePersistenceService;
    /**
     * @var OrderPersistenceService
     */
    private OrderPersistenceService $orderPersistenceService;

    public function __construct(
        ApplicationPersistenceService $applicationPersistenceService,
        DevicePersistenceService $devicePersistenceService,
        OrderPersistenceService $orderPersistenceService
    ) {
        $this->applicationPersistenceService = $applicationPersistenceService;
        $this->devicePersistenceService = $devicePersistenceService;
        $this->orderPersistenceService = $orderPersistenceService;
    }

    public function login(LoginRequest $loginRequest): LoginDTO
    {
        $loginDto = new LoginDTO();

        // TODO burada tek seferde DB'ye gitmek daha performanslı olabilir test edildikten sonra karar verilmeli.
        try {
            $deviceDto = $this->devicePersistenceService->getDevice($loginRequest->getUid(), $loginRequest->getAppId());
            $loginDto->setDevice($deviceDto);
        } catch (DeviceNotFoundException $deviceNotFoundException) {

        }

        try {
            $appDto = $this->applicationPersistenceService->getApplication($loginRequest->getAppId());
            $loginDto->setApp($appDto);
        } catch (ApplicationNotFoundException $applicationNotFoundException) {

        }

        $orderDto = $this->orderPersistenceService->getActiveOrder($loginRequest->getUid(), $loginRequest->getAppId());
        if (!empty($orderDto)) {
            $loginDto->setStatus(OrderStatus::ACTIVE);
        }

        return $loginDto;
    }
}
