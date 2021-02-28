<?php
declare(strict_types=1);

namespace App\Constant;

use JetBrains\PhpStorm\Pure;

class OrderStatus
{
    const ACTIVE = 'ACTIVE';
    const PASSIVE = 'PASSIVE';

    public static array $codes = [
        self::ACTIVE => 1,
        self::PASSIVE => 2,
    ];

    #[Pure]
    public static function translate(string $status): int
    {
        if (!in_array($status, self::$codes)) {
            // TODO throw exception
        }

        return self::$codes[$status];
    }
}
