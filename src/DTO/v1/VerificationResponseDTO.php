<?php
declare(strict_types=1);

namespace App\DTO\v1;

use DateTime;

class VerificationResponseDTO
{
    /**
     * @var bool
     */
    private bool $status;
    /**
     * @var DateTime
     */
    private DateTime $expiredDate;

    /**
     * @return bool
     */
    public function isStatus(): bool
    {
        return $this->status;
    }

    /**
     * @param bool $status
     */
    public function setStatus(bool $status): void
    {
        $this->status = $status;
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
}
