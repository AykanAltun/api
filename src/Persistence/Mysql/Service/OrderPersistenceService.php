<?php
declare(strict_types=1);

namespace App\Persistence\Mysql\Service;

use App\Constant\OrderStatus;
use App\DTO\v1\OrderDTO;
use App\Entity\v1\Order;
use App\Persistence\Mysql\Convertor\OrderConvertor;
use Doctrine\ORM\EntityManagerInterface;

class OrderPersistenceService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getActiveOrder(int $uid, int $appId): ?OrderDTO
    {
        /** @var Order $order */
        $order = $this->entityManager->getRepository(Order::class)
            ->findOneBy([
                'uid' => $uid,
                'appId' => $appId,
                'status' => OrderStatus::translate(OrderStatus::ACTIVE)
            ]);
        if (empty($order)) {
            return null;
        }

        return OrderConvertor::toDto($order);
    }

    public function save(Order $order): void
    {
        $this->entityManager->persist($order);
        $this->entityManager->flush();
    }
}
