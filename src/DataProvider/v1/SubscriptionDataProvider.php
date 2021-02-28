<?php
declare(strict_types=1);

namespace App\DataProvider\v1;

class SubscriptionDataProvider
{
    public function provideSubscriptionRequest(): array
    {
        return [[[
            'uid' => rand(3000000, 4000000), 'language' => 'TURKISH', 'operatingSystem' => 'LINUX'
        ]]];
    }
}
