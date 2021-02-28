<?php
declare(strict_types=1);

namespace App\Service\v1;

use App\DTO\v1\DeviceDTO;
use App\Exception\DeviceNotFoundException;
use App\Persistence\Mysql\Convertor\DeviceConvertor;
use App\Persistence\Mysql\Service\DevicePersistenceService;
use App\Request\v1\RegisterRequest;

class RegisterService
{
    /**
     * @var DevicePersistenceService
     */
    private DevicePersistenceService $devicePersistenceService;

    public function __construct(DevicePersistenceService $devicePersistenceService)
    {
        $this->devicePersistenceService = $devicePersistenceService;
    }

    public function register(RegisterRequest $registerRequest): DeviceDTO
    {
        try {
            $deviceDto = $this->devicePersistenceService->getDevice(
                $registerRequest->getUid(),
                $registerRequest->getAppId()
            );
        } catch (DeviceNotFoundException $deviceNotFoundException) {
            $device = $registerRequest->toEntity();
            $this->devicePersistenceService->save($device);
            $deviceDto = DeviceConvertor::toDto($device);
        }

        return $deviceDto;
    }
}
