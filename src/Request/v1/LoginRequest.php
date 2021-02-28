<?php
declare(strict_types=1);

namespace App\Request\v1;

use App\Request\RequestInterface;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @OA\RequestBody(
 *     request="LoginRequest",
 *     description="Login object",
 *     required=true,
 *     @OA\JsonContent(ref="#/components/schemas/LoginRequest")
 * )
 * @OA\Schema(@OA\Xml(name="LoginRequest"))
 */
class LoginRequest implements RequestInterface
{
    /**
     * @var int
     * @OA\Property(type="integer")
     * @Assert\NotBlank(message="Aygıt Id boş bırakılamaz.")
     * @Assert\NotNull(message="Aygıt Id null olamaz.")
     * @Assert\GreaterThan(value="0", message="Aygıt Id sıfırdan büyük bir sayı olmalıdır.")
     */
    private int $uid;
    /**
     * @var int
     * @OA\Property(type="integer")
     * @Assert\NotBlank(message="Uygulama Id boş bırakılamaz.")
     * @Assert\NotNull(message="Uygulama Id null olamaz.")
     * @Assert\GreaterThan(value="0", message="Uygulama Id sıfırdan büyük bir sayı olmalıdır.")
     */
    private int $appId;

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

    public function fill(?array $data = null): void
    {
        $this->uid = $data['uid'] ?? 0;
        $this->appId = $data['appId'] ?? 0;
    }
}
