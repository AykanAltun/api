<?php
declare(strict_types=1);

namespace App\DTO\v1;

use JetBrains\PhpStorm\ArrayShape;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(@OA\Xml(name="Application"))
 */
class ApplicationDTO
{
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
     * @var string
     * @OA\Property(type="string")
     */
    private string $name;
    /**
     * @var bool
     * @OA\Property(type="bool")
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

    #[ArrayShape(['appId' => "int", 'price' => "float", 'name' => "string", 'isActive' => "bool"])]
    public function toArray(): array
    {
        return [
            'appId' => $this->appId,
            'price' => $this->price,
            'name' => $this->name,
            'isActive' => $this->isActive,
        ];
    }

    public static function toDto(array $app): self
    {
        $appDto = new ApplicationDTO();
        $appDto->setAppId($app['appId']);
        $appDto->setPrice($app['price']);
        $appDto->setName($app['name']);
        $appDto->setIsActive($app['isActive']);

        return $appDto;
    }
}
