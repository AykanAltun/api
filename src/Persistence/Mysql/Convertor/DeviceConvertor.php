<?php
declare(strict_types=1);

namespace App\Persistence\Mysql\Convertor;

use App\DTO\v1\DeviceDTO;
use App\Entity\v1\Device;

class DeviceConvertor
{
    public static function toDto(Device $device): DeviceDTO
    {
        $deviceDTO = new DeviceDTO();
        $deviceDTO->setUid($device->getUid());
        $deviceDTO->setAppId($device->getAppId());
        $deviceDTO->setLanguage($device->getLanguage());
        $deviceDTO->setOperatingSystem($device->getOperatingSystem());
        $deviceDTO->setCreatedDate($device->getCreatedDate());

        return $deviceDTO;
    }
}
