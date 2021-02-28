<?php
declare(strict_types=1);

namespace App\DataProvider\v1;

class LoginDataProvider
{
    public function provideLoginRequest(): array
    {
        $id = rand(2000000, 3000000);
        return [[[
            'login' => ['uid' => $id],
            'register' => ['uid' => $id, 'language' => 'TURKISH', 'operatingSystem' => 'LINUX'],
        ]]];
    }
}
