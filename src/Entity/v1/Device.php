<?php
declare(strict_types=1);

namespace App\Entity\v1;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Table(name="devices")
 * @UniqueEntity(fields={"uid, app_id"})
 * @ORM\Entity()
 */
class Device
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer", name="uid", nullable=false)
     */
    private int $uid;
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer", name="app_id", nullable=false)
     */
    private int $appId;
    /**
     * @var int
     * @ORM\Column(type="integer", name="language", nullable=false)
     */
    private int $language;
    /**
     * @var int
     * @ORM\Column(type="integer", name="operating_system", nullable=false)
     */
    private int $operatingSystem;
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
     * @var bool
     * @ORM\Column(
     *     type="boolean",
     *     name="is_active",
     *     nullable=false,
     *     options={"default": true}
     * )
     */
    private bool $isActive = true;

    public function __construct()
    {
        $this->createdDate = new DateTime();
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
}
