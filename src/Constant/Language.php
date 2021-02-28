<?php
declare(strict_types=1);

namespace App\Constant;

use JetBrains\PhpStorm\Pure;

class Language
{
    const TURKISH = 'TURKISH';
    const ENGLISH = 'ENGLISH';

    public static array $codes = [
        self::TURKISH => 1,
        self::ENGLISH => 2,
    ];

    #[Pure]
    public static function translate(string $language): int
    {
        if (!in_array($language, self::$codes)) {
            // TODO throw exception
        }

        return self::$codes[$language];
    }
}
