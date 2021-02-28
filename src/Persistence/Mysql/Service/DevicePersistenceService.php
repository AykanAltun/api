<?php
declare(strict_types=1);

namespace App\Persistence\Mysql\Service;

use App\DTO\v1\DeviceDTO;
use App\Entity\v1\Device;
use App\Exception\DeviceNotFoundException;
use App\Persistence\Mysql\Convertor\DeviceConvertor;
use Doctrine\ORM\EntityManagerInterface;

class DevicePersistenceService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getDevice(int $uid, int $appId): DeviceDTO
    {
        /** @var Device $device */
        $device = $this->entityManager->getRepository(Device::class)
            ->findOneBy(['uid' => $uid, 'appId' => $appId]);
        if (empty($device)) {
            throw new DeviceNotFoundException("Aygıt bulunamadı.");
        }

        return DeviceConvertor::toDto($device);
    }

    public function save(Device $device): void
    {
        $this->entityManager->persist($device);
        $this->entityManager->flush();
    }
}
