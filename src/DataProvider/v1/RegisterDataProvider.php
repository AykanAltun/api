<?php
declare(strict_types=1);

namespace App\DataProvider\v1;

use App\Constant\Language;
use App\Constant\OperatingSystem;

class RegisterDataProvider
{
    public function provideRegisterRequest(): array
    {
        return [[[
            'uid' => rand(1000000, 2000000),
            'language' => Language::TURKISH,
            'operatingSystem' => OperatingSystem::MACOS
        ]]];
    }
}
