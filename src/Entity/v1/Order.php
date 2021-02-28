<?php
declare(strict_types=1);

namespace App\Entity\v1;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="orders", indexes={@ORM\Index(name="search_idx", columns={"uid", "app_id", "status"})})
 * @ORM\Entity()
 */
class Order
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private int $id;
    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private int $uid;
    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private int $appId;
    /**
     * @var float
     * @ORM\Column(type="float", name="price", nullable=false)
     */
    private float $price;
    /**
     * @var DateTime
     * @ORM\Column(
     *     type="datetime",
     *     name="created_date",
     *     nullable=false,
     *     options={"default": "CURRENT_TIMESTAMP"}
     * )
     */
    private DateTime $createdDate;
    /**
     * @var DateTime
     * @ORM\Column(
     *     type="datetime",
     *     name="expired_date",
     *     nullable=false,
     *     options={"default": "CURRENT_TIMESTAMP"}
     * )
     */
    private DateTime $expiredDate;
    /**
     * @var int
     * @ORM\Column(type="integer", name="status", nullable=false)
     */
    private int $status;

    public function __construct()
    {
        $this->createdDate = new DateTime();
    }

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
}
