<?php
declare(strict_types=1);

namespace App\DataProvider\v1;

class PurchaseDataProvider
{
    public function providePurchaseRequest(): array
    {
        return [[[
            'purchase' => ['receipt' => '58423502141'],
            'register' => ['uid' => rand(4000000, 5000000), 'language' => 'TURKISH', 'operatingSystem' => 'LINUX'],
        ]]];
    }
}
