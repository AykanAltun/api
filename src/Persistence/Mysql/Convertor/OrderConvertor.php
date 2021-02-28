<?php
declare(strict_types=1);

namespace App\Persistence\Mysql\Convertor;

use App\DTO\v1\OrderDTO;
use App\Entity\v1\Order;

class OrderConvertor
{
    public static function toDto(Order $order): OrderDTO
    {
        $orderDto = new OrderDTO();
        $orderDto->setUid($order->getUid());
        $orderDto->setAppId($order->getAppId());
        $orderDto->setPrice($order->getPrice());
        $orderDto->setStatus($order->getStatus());
        $orderDto->setExpiredDate($order->getExpiredDate());
        $orderDto->setId($order->getId());
        $orderDto->setCreatedDate($order->getCreatedDate());

        return $orderDto;
    }
}
