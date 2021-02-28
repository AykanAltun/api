<?php
declare(strict_types=1);

namespace App\DTO\v1;

use App\Constant\OrderStatus;
use JetBrains\PhpStorm\ArrayShape;

class LoginDTO
{
    /**
     * @var DeviceDTO
     */
    private DeviceDTO $device;
    /**
     * @var ApplicationDTO
     */
    private ApplicationDTO $app;
    /**
     * @var string
     */
    private string $status = OrderStatus::PASSIVE;

    /**
     * @return DeviceDTO
     */
    public function getDevice(): DeviceDTO
    {
        return $this->device;
    }

    /**
     * @param DeviceDTO $device
     */
    public function setDevice(DeviceDTO $device): void
    {
        $this->device = $device;
    }

    /**
     * @return ApplicationDTO
     */
    public function getApp(): ApplicationDTO
    {
        return $this->app;
    }

    /**
     * @param ApplicationDTO $app
     */
    public function setApp(ApplicationDTO $app): void
    {
        $this->app = $app;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }


    #[ArrayShape(['device' => "array", 'app' => "array", 'status' => "string"])]
    public function toArray(): array
    {
        return [
            'device' => [
                'uid' => $this->device->getUid(),
                'appId' => $this->device->getAppId(),
                'language' => $this->device->getLanguage(),
                'operatingSystem' => $this->device->getOperatingSystem(),
                'createdDate' => $this->device->getCreatedDate(),
                'isActive' => $this->device->isActive(),
            ],
            'app' => [
                'appId' => $this->app->getAppId(),
                'price' => $this->app->getPrice(),
                'name' => $this->app->getName(),
                'isActive' => $this->app->isActive(),
            ],
            'status' => $this->status,
        ];
    }
}
