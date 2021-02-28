<?php
declare(strict_types=1);

namespace App\Entity\v1;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Table(name="applications")
 * @UniqueEntity(fields={"appId"})
 * @ORM\Entity()
 */
class Application
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer", name="app_id", nullable=false, unique=true)
     */
    private int $appId;
    /**
     * @var float
     * @ORM\Column(type="float", name="price", nullable=false)
     */
    private float $price;
    /**
     * @var string
     * @ORM\Column(type="string", name="name", nullable=false)
     */
    private string $name;
    /**
     * @var bool
     * @ORM\Column(
     *     type="boolean",
     *     name="is_active",
     *     nullable=false,
     *     options={"default": true}
     * )
     */
    private bool $isActive;

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
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
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
