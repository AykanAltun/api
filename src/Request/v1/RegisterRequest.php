<?php
declare(strict_types=1);

namespace App\Request\v1;

use App\Constant\Language;
use App\Constant\OperatingSystem;
use App\Entity\v1\Device;
use App\Request\RequestInterface;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @OA\RequestBody(
 *     request="RegisterRequest",
 *     description="Register object",
 *     required=true,
 *     @OA\JsonContent(ref="#/components/schemas/RegisterRequest")
 * )
 * @OA\Schema(@OA\Xml(name="RegisterRequest"))
 */
class RegisterRequest implements RequestInterface
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
     * @var string
     * @OA\Property(type="string", enum={"TURKISH", "ENGLISH"})
     * @Assert\NotBlank(message="Dil alanı boş bırakılamaz.")
     * @Assert\NotNull(message="Dil alanı null olamaz.")
     * @Assert\Choice({"TURKISH", "ENGLISH"}, message="Geçerli diller TURKISH ya da ENGLISH olmalıdır.")
     */
    private string $language;
    /**
     * @var string
     * @OA\Property(type="string", enum={"MACOS", "LINUX"})
     * @Assert\NotBlank(message="İşletim sistemi alanı boş bırakılamaz.")
     * @Assert\NotNull(message="İşletim sistemi alanı null olamaz.")
     * @Assert\Choice({"MACOS", "LINUX"}, message="Geçerli işletim sistemleri MACOS ya da LINUX olmalıdır.")
     */
    private string $operatingSystem;

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
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @param string $language
     */
    public function setLanguage(string $language): void
    {
        $this->language = $language;
    }

    /**
     * @return string
     */
    public function getOperatingSystem(): string
    {
        return $this->operatingSystem;
    }

    /**
     * @param string $operatingSystem
     */
    public function setOperatingSystem(string $operatingSystem): void
    {
        $this->operatingSystem = $operatingSystem;
    }

    public function fill(?array $data = null): void
    {
        $this->uid = $data['uid'] ?? 0;
        $this->appId = $data['appId'] ?? 0;
        $this->language = $data['language'] ?? '';
        $this->operatingSystem = $data['operatingSystem'] ?? '';
    }

    public function toEntity(): Device
    {
        $register = new Device();
        $register->setUid($this->uid);
        $register->setAppId($this->appId);
        $register->setLanguage(Language::translate($this->language));
        $register->setOperatingSystem(OperatingSystem::translate($this->operatingSystem));

        return $register;
    }
}
