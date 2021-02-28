<?php
declare(strict_types=1);

namespace App\Constant;

use JetBrains\PhpStorm\Pure;

class OperatingSystem
{
    const MACOS = 'MACOS';
    const LINUX = 'LINUX';

    public static array $codes = [
        self::MACOS => 1,
        self::LINUX => 2,
    ];

    #[Pure]
    public static function translate(string $operatingSystem): int
    {
        if (!in_array($operatingSystem, self::$codes)) {
            // TODO throw exception
        }

        return self::$codes[$operatingSystem];
    }
}
