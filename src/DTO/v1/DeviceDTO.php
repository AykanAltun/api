<?php
declare(strict_types=1);

namespace App\DTO\v1;

use App\Entity\v1\Device;
use DateTime;
use JetBrains\PhpStorm\ArrayShape;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(@OA\Xml(name="Register"))
 */
class DeviceDTO
{
    /**
     * @var int
     * @OA\Property(type="integer")
     */
    private int $uid;
    /**
     * @var int
     * @OA\Property(type="integer")
     */
    private int $appId;
    /**
     * @var int
     * @OA\Property(type="integer")
     */
    private int $language;
    /**
     * @var int
     * @OA\Property(type="integer")
     */
    private int $operatingSystem;
    /**
     * @var bool
     * @OA\Property(type="bool")
     */
    private bool $isActive = true;
    /**
     * @var DateTime
     * @OA\Property(type="datetime")
     */
    private DateTime $createdDate;

    /**
     * @return int
     */
    public function getUid(): int
    {
        return $this->uid;
    }

    /**
     * @param int $uid
     */
    public function setUid(int $uid): void
    {
        $this->uid = $uid;
    }

    /**
     * @return int
     */
    public function getAppId(): int
    {
        return $this->appId;
    }

    /**
     * @param int $appId
     */
    public function setAppId(int $appId): void
    {
        $this->appId = $appId;
    }

    /**
     * @return int
     */
    public function getLanguage(): int
    {
        return $this->language;
    }

    /**
     * @param int $language
     */
    public function setLanguage(int $language): void
    {
        $this->language = $language;
    }

    /**
     * @return int
     */
    public function getOperatingSystem(): int
    {
        return $this->operatingSystem;
    }

    /**
     * @param int $operatingSystem
     */
    public function setOperatingSystem(int $operatingSystem): void
    {
        $this->operatingSystem = $operatingSystem;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     */
    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
    }

    /**
     * @return DateTime
     */
    public function getCreatedDate(): DateTime
    {
        return $this->createdDate;
    }

    /**
     * @param DateTime $createdDate
     */
    public function setCreatedDate(DateTime $createdDate): void
    {
        $this->createdDate = $createdDate;
    }

    public function fill(Device $device): void
    {
        $this->uid = $device->getUid();
        $this->appId = $device->getAppId();
        $this->language = $device->getLanguage();
        $this->operatingSystem = $device->getOperatingSystem();
        $this->isActive = $device->isActive();
        $this->createdDate = $device->getCreatedDate();
    }


    #[ArrayShape([
        'uid' => "int",
        'appId' => "int",
        'language' => "int",
        'operatingSystem' => "int",
        'isActive' => "bool",
        'createdDate' => "\DateTime"
    ])]
    public function toArray(): array
    {
        return [
            'uid' => $this->uid,
            'appId' => $this->appId,
            'language' => $this->language,
            'operatingSystem' => $this->operatingSystem,
            'isActive' => $this->isActive,
            'createdDate' => $this->createdDate,
        ];
    }

    public static function toDto(array $device): self
    {
        $deviceDto = new DeviceDTO();
        $deviceDto->setUid($device['uid']);
        $deviceDto->setAppId($device['appId']);
        $deviceDto->setLanguage($device['language']);
        $deviceDto->setOperatingSystem($device['operatingSystem']);
        $deviceDto->setCreatedDate(DateTime::__set_state((array) $device['createdDate']));
        $deviceDto->setIsActive($device['isActive']);

        return $deviceDto;
    }
}
