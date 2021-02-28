<?php
declare(strict_types=1);

namespace App\Request\v1;

use App\DTO\v1\ApplicationDTO;
use App\DTO\v1\DeviceDTO;
use App\DTO\v1\VerificationResponseDTO;
use App\Entity\v1\Order;
use App\Request\RequestInterface;
use DateTime;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @OA\RequestBody(
 *     request="PurchaseRequest",
 *     description="Purchase object",
 *     required=true,
 *     @OA\JsonContent(ref="#/components/schemas/PurchaseRequest")
 * )
 * @OA\Schema(@OA\Xml(name="PurchaseRequest"))
 */
class PurchaseRequest implements RequestInterface
{
    /**
     * @var string
     * @OA\Property(type="string")
     * @Assert\NotBlank(message="receipt boş bırakılamaz.")
     * @Assert\NotNull(message="receipt null olamaz.")
     */
    private string $receipt;
    /**
     * @var DeviceDTO
     */
    private DeviceDTO $device;
    /**
     * @var ApplicationDTO
     */
    private ApplicationDTO $app;
    /**
     * @var float
     */
    private float $price;
    /**
     * @var DateTime
     */
    private DateTime $expiredDate;
    /**
     * @var int
     */
    private int $status;

    /**
     * @return string
     */
    public function getReceipt(): string
    {
        return $this->receipt;
    }

    /**
     * @param string $receipt
     */
    public function setReceipt(string $receipt): void
    {
        $this->receipt = $receipt;
    }

    /**
     * @return DeviceDTO
     */
    public function getDevice(): DeviceDTO
    {
        return $this->device;
    }

    /**
     * @param DeviceDTO $device
     */
    public function setDevice(DeviceDTO $device): void
    {
        $this->device = $device;
    }

    /**
     * @return ApplicationDTO
     */
    public function getApp(): ApplicationDTO
    {
        return $this->app;
    }

    /**
     * @param ApplicationDTO $app
     */
    public function setApp(ApplicationDTO $app): void
    {
        $this->app = $app;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @param DateTime $expiredDate
     */
    public function setExpiredDate(DateTime $expiredDate): void
    {
        $this->expiredDate = $expiredDate;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function setVerificationResponse(VerificationResponseDTO $verificationResponseDTO): void
    {
        $this->expiredDate = $verificationResponseDTO->getExpiredDate();
        $this->status = (int) $verificationResponseDTO->isStatus();
    }

    public function fill(?array $data = null): void
    {
        $this->receipt = $data['receipt'] ?? '';
    }

    public function toEntity(): Order
    {
        $order = new Order();
        $order->setUid($this->device->getUid());
        $order->setAppId($this->app->getAppId());
        $order->setPrice($this->app->getPrice());
        $order->setExpiredDate($this->expiredDate);
        $order->setStatus($this->status);

        return $order;
    }
}
