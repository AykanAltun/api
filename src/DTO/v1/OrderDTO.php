<?php
declare(strict_types=1);

namespace App\DTO\v1;

use DateTime;
use JetBrains\PhpStorm\ArrayShape;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(@OA\Xml(name="Order"))
 */
class OrderDTO
{
    /**
     * @var int
     * @OA\Property(type="integer")
     */
    private int $id;
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
     * @var float
     * @OA\Property(type="float")
     */
    private float $price;
    /**
     * @var DateTime
     * @OA\Property(type="datetime")
     */
    private DateTime $createdDate;
    /**
     * @var DateTime
     * @OA\Property(type="datetime")
     */
    private DateTime $expiredDate;
    /**
     * @var int
     * @OA\Property(type="integer")
     */
    private int $status;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

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
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
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

    /**
     * @return DateTime
     */
    public function getExpiredDate(): DateTime
    {
        return $this->expiredDate;
    }

    /**
     * @param DateTime $expiredDate
     */
    public function setExpiredDate(DateTime $expiredDate): void
    {
        $this->expiredDate = $expiredDate;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    #[ArrayShape([
        'id' => "int",
        'uid' => "int",
        'appId' => "int",
        'price' => "float",
        'expiredDate' => "\DateTime",
        'status' => "int",
        'createdDate' => "\DateTime"
    ])]
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'uid' => $this->uid,
            'appId' => $this->appId,
            'price' => $this->price,
            'expiredDate' => $this->expiredDate,
            'status' => $this->status,
            'createdDate' => $this->createdDate,
        ];
    }
}
