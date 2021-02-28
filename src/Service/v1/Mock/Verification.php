<?php
declare(strict_types=1);

namespace App\Service\v1\Mock;

use App\DTO\v1\VerificationResponseDTO;
use DateTime;
use DateTimeZone;

class Verification
{
    const OFFSET = -1;
    const ONE = 1;
    const TWO = 2;

    public function verify(string $receipt): VerificationResponseDTO
    {
        $verificationResponseDto = new VerificationResponseDTO();
        $verificationResponseDto->setExpiredDate(new DateTime('now', new DateTimeZone('UTC -6')));
        $verificationResponseDto->setStatus(false);
        if ((int) substr($receipt, self::OFFSET) % self::TWO === self::ONE) {
            $verificationResponseDto->setStatus(true);
        }

        return $verificationResponseDto;
    }
}
